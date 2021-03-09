<?php
use \Outlet\UI\Alert;
use \Coupon\Controller\Partner;
use \Coupon\Model\CouponCode;
use \Coupon\Model\Coupon;
use \Coupon\Model\Client;
use \Coupon\Api\Client as ApiClient;
use \Coupon\BL\CouponValidator;
use \Coupon\BL\CouponRedemption;
use \Coupon\Translator\Columns;
use \Coupon\View\Table\Column;
use Coupon\BL\CouponDistributor;

class toolsController extends Partner
{

    public $uses = array('coupon','couponCode', 'redemption');

    public $helpers = array('url', 'form');

    /**
     *
     */
    public function __construct()
    {

        parent::__construct();
        $this->addHeaderCSS('/partner/css/plugins/dataTables.bootstrap.css');

    }


    /**
     * view coupon code
     *
     */
    public function index()
    {


    }

    /**
     * Get a coupon code by given coupon Uuid via API
     */
    public function getCode()
    {
         try{
            $this->setPageTitle('获取优惠券号码');
            $partnerUuid = $this->_getUserFromSession('partnerUuid'); // bin
            $m = new Coupon();
            $this->set('coupons', $m->findAllInPair(bin2hex($partnerUuid)));

            if (isset($_POST['submit'])) {
                $couponUuid = $this->_getRequired('couponUuid');
                $randomCouponCode = new \Coupon\BL\CouponSelector();
                $couponCode = $randomCouponCode->setCouponUuid($couponUuid)->random();
                $this->set('data',$couponCode)
                    ->set('valueFilter', self::_getFilter());
            }
         } catch (\Exception $e) {
             $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
         }
    }

    /**
     * check the coupon code status
     *
     *
     */
    public function status()
    {
        try {
            $this->setPageTitle('代码状态查询');
            $this->_setClients();

            if (isset($_REQUEST['submit'])) {
                $terminalUuid = trim($this->_getRequired('clientUuid'));
                $couponCode = trim($this->_getRequired('couponCode'));
                $validator = new CouponValidator($terminalUuid, $couponCode);
                $isValid = $validator->isValid(CouponValidator::VALID_TYPE_CHECK);
                $this->set('validator', $validator)
                    ->set('couponCode', $couponCode)
                    ->set('valueFilter', self::_getFilter())
                    ->set('isValid', $isValid);
                return;
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }
    }

    /**
     * 发送优惠券代码
     * 1 选取一个号码
     * 2 更新优惠券状态
     * 3 记录发布记录
     * 4 发送或者显示
     *
     */
    public function distribute()
    {
        $this->setPageTitle('发送优惠券代码');
        $partnerUuid = $this->_getUserFromSession('partnerUuid');
        $m = new Coupon();
        $this->set('coupons', $m->findAllInPair(bin2hex($partnerUuid)));

        if (isset($_POST['submit']) && 'submit' == $_POST['submit']){
            $couponUuid = $this->_getRequired('couponUuid');
            try {
                $logic = new CouponDistributor($couponUuid);
                $logic->distribute();
                $couponCodeData = $logic->getCouponCode()->toArray();
                $this->set('couponCode', $couponCodeData)
                    ->set('coupon', $logic->getCoupon()->toArray());
                $this->_writeDeliveryHistory($couponCodeData, $_REQUEST);

                // send coupon
                if (isset($_POST['noSend'])) {
                    // send code
                    $this->set("notSendCode", $couponCodeData);
                } else {
                    // send code
                }
            } catch (\Exception $e) {
                $this->_addMessagebox(Alert::TYPE_DANG, '无法获取优惠券号码' .$e->getMessage(), null, null);
            }
        }

    }

    /**
     * @throws Exception
     */
    public function redemption()
    {
        try{
            $this->setPageTitle('使用优惠券');
            $this->_setClients();

            if (isset($_POST['submit'])) {
                $clientUuid = $this->_getRequired('clientUuid');// 终端id
                $couponCode = $this->_getRequired('couponCode');
                $r = new CouponRedemption($clientUuid, $couponCode);
                if ($r->begin()) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, 'OK ' , null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败 ', null, null);
                }
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }
    }

    /**
     * 优惠券使用记录
     */
    public function redemptionlog()
    {
        try {
            $this->setPageTitle('优惠券使用记录')
                ->_setClients();

            if (isset($_POST['submit'])) {
                $clientUuid = $this->_getRequired('clientUuid');
                $r = $this->redemption->find('all', array('conditions'=>array('clientUuid'=>hex2bin($clientUuid))));
                $this->set('redemptionLog', $r);
                // 隐藏列
                $hid = array('id', 'clientUuid', 'partnerUuid', 'usedCodeHash', 'lastmodify',
                    'consumerFirstName', 'consumerLastName', 'consumerEmail', 'consumerOrderId',
                    'consumerOrderValue', 'consumerOrderCurrency', 'consumerAddress','consumerZipcode',
                    'consumerPhone', 'consumerSession'
                );

                // 定义翻译列名
                $translate = new Columns();
                $translate->setMapping(array(
                    'usedCode' => '使用的优惠券代码',
                    'ip'=> 'IP地址',
                    'time' => '消费时间',
                    'costType' => '计费方式',
                    'costValue' => '费用',
                    'costCurrency' => '计费单位',
                    'created' => '创建时间'
                ));

                // 定义附加列
                $extraColumn = new Column();
                $extraColumn->title = "操作";
                $extraColumn->tpl = 'Partner/Tools/RedemptionButtonLink';

                $this->set('hiddenColumns', $hid)
                    ->set('columnsTranslator', $translate)
                    ->set('extraColumns', array($extraColumn));
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }
    }


    public function redemptionLogDetail()
    {
        $id = $this->_getRequired('id');
        $redemptionLog=$this->redemption->loadByPrimaryKey($id)->toArray();

        $keyTranslator  = new Columns();
        $keyTranslator->setMapping(array(
            'usedCode' => '使用的优惠券代码',
            'ip'=> 'IP地址',
            'time' => '消费时间',
            'costType' => '计费方式',
            'costValue' => '费用',
            'costCurrency' => '计费单位',
            'created' => '创建时间'
            )
        );

        $valueFilter = $this->_getFilter();

        $this->set('redemptionLog', $redemptionLog)
            ->set('keyTranslator', $keyTranslator)
            ->set('valueFilter', $valueFilter);
    }

    /**
     * Set the client list in VIEW by partner UUID in session.
     *
     */
    private function _setClients()
    {
        $partnerUuid = $this->_getUserFromSession('partnerUuid');
        $m = new Client();
        $this->set('clients', $m->fetchByPartnerUuid($partnerUuid));
        return $this;
    }


    /**
     * write the delivery history
     */
    private function _writeDeliveryHistory(array $couponCode, array $post)
    {
        /*
        $param = array('');
        $m = getModel('deliveryHistory');
        $this->('clientUuid', null )
            ->set('partnerUuid', null)// bin 16
            ->set('deliverCouponCodeId', null)// coupon code id
            ->set('deliverCouponCode', null)// vchar 255 Used Code
            ->set('deliverCouponCodeHash', null)// bin16
            ->set('operatorIp', nul) // The IP of operator

            'costType', // ENUM
            'costValue', // DECIMAL 13,4
            'costCurrency', // CHAR 3
            'consumerFirstName',
            'consumerLastName',
            'consumerEmail',
            'deliveryReason',
            'created', // timestamp (auto)
            'lastmodify' // timestamp (auto)
        */
    }

}
/* EOF */