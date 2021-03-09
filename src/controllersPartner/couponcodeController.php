<?php
use Outlet\UI\Alert;
use Coupon\Controller\Partner;
use Coupon\Model\CouponCode;
use Coupon\Translator\Columns;
use Coupon\Filter\ColumnValue;
use Coupon\BL\CouponValidator;
use Coupon\BL\CouponCodeImporter;

class couponcodeController extends Partner
{

    public $uses = array('coupon','couponCode');

    public $helpers = array('url', 'form');

    private $_translate = array(
        'clientUuid' => '客户端标示',
        'partnerUuid' => '合作伙伴标示',
        'couponUuid' => '优惠券标示',
        'created' => '创建',
        'lastmodify' => '最后修改',
        'name' => '名字',
        'description' => '描述',
        'countCoupon' => '已绑定的优惠券',
        'status' => '状态',
        'code' => '号码',
        'codeHash' => '号码哈希',
        'isDeliverd' => '已发送',
        'timeUsed' => '已使用次数',
        'allowTimeUsed' => '允许使用次数',
        'validFrom' => '有效期开始',
        'validUntil' => '有效期结束'
    );

    /**
     *
     */
    public function __construct()
    {

        parent::__construct();
        $this->addHeaderCSS('/partner/css/plugins/dataTables.bootstrap.css');

    }


    /**
     * view all coupon code in one coupn
     *
     */
    public function index()
    {
        try {
            $couponUuid = hex2bin($this->_getRequired('couponUuid')); // bin
            $this->set("couponUuid", $couponUuid);
            //$this->set('codes', $this->couponCode->find('all', array('conditions'=>array('couponUuId'=> $couponUuid))));
            $m = new \Coupon\Model\CouponCode();
            $this->set('codes', $m->findByCouponUuid($this->_getRequired('couponUuid')));
            $this->set('extraColumnsTpl', 'CouponCode');
            $coupon = $this->coupon->loadByPrimaryKey($couponUuid)->toArray();
            $this->set('coupon', $coupon);
            // 定义隐藏列
            $this->set('hiddenColumns', array('id', 'couponUuid','codeHash','partnerId', 'partnerUuid', 'clientUuid'));
            $this->setPageTitle('显示优惠券代码:' . $coupon['name']);
            // 定义翻译
            $translate = new Columns();
            $translate->setMapping($this->_translate);
            $this->set('columnsTranslator', $translate);

            // 定义附加列
            $extraColumn = new Coupon\View\Table\Column();
            $extraColumn->title = "操作";
            $extraColumn->tpl = 'CouponCode';
            $this->set('extraColumns', array($extraColumn));

            // 定义列过滤器
            /**
            $callback = function($string, $row) {
            return bin2hex($string);
            };
             */
            $filter= new ColumnValue();
            $filter->addMapping('isDeliverd', $this->_getIsDeliveredFilter());
            $this->set('columnsFilter', $filter);
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
            $this->render("error");
        }
    }


    /**
     * Add a new coupon code manual
     *
     */
    public function add()
    {
        try{
            $this->setPageTitle("添加新优惠券号码(手动)");
            $this->addHeaderCSS('/partner/css/bootstrap-datetimepicker.min.css')
                ->addHeaderJS('/partner/js/bootstrap-datetimepicker.min.js');
            $this->set('action', 'add');

            $couponUuid = trim($this->_getRequired('couponUuid'));
            $coupon = $this->coupon->loadByPrimaryKey(hex2bin($couponUuid))->toArray();
            $this->set('coupon', $coupon);

            if (isset($_POST['submit'])) {
                $couponCode = $this->_getRequired('couponCode');
                $maxTimeUsed = $this->_getRequired('maxTimeUsed');
                $clientUuid = bin2hex($coupon['clientUuid']);
                $partnerUuid = bin2hex($coupon['partnerUuid']);

                $validator = new CouponValidator($clientUuid, $couponCode);
                $findCodeResult = $validator->getResult();
                $validator->checkCode($findCodeResult);
                $amount = 1; // only one code every time

                if(!$validator->isCodeCorrect()) {
                    // not found. Can insert
                    $request = array();
                    $request['couponCode'] = $couponCode;
                    $request['amount'] = $amount ;
                    $request['couponUuid'] = $couponUuid; // hex string
                    $request['partnerUuid'] = $partnerUuid; // hex sting
                    $request['clientUuid'] = $clientUuid; // bin
                    $request['allowTimeUsed'] = $maxTimeUsed;
                    $request['validFrom'] = isset($_REQUEST['validFrom']) ? $_REQUEST['validFrom'] : null;
                    $request['validUntil'] = isset($_REQUEST['validUntil']) ?  $_REQUEST['validUntil'] : null;
                    $this->_addCouponCode($request);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, sprintf('优惠码 %s 已被使用。请使用别的号码。', $couponCode), null, null);
                }
            }

        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, sprintf('错误: %s', $e->getMessage()), null, null);
        }


    }

    /**
     * Remove a coupon
     */
    public function del()
    {

    }

    public function edit()
    {

    }

    /**
     * Batch import coupon code
     * Step 1. Upload fiels and generate a import form page (PreView)
     * Step 2. import the code
     *
     *
     *
     */
    public function import()
    {
        try{
            $this->setPageTitle("批量导入优惠劵");
            $couponUuid = trim($this->_getRequired('couponUuid'));
            $coupon = $this->coupon->loadByPrimaryKey(hex2bin($couponUuid))->toArray();
            $this->set('coupon', $coupon);
            if (isset($_POST['preview'])) {
                // Preview
                $uploader = new CouponCodeImporter($_FILES);
                $codes = $uploader->import()->getCodesToImport();
                $this->set('codes', $codes);
                return $this->render('importPreview');
            } elseif (isset($_POST['importConfirm'])) {
                // Import
                $partnerUuid = $this->_getUserFromSession('partnerUuid'); // bin;
                $clientUuid = $coupon['clientUuid']; // bin
                $couponUuid = $coupon['uuid']; // bin
                $count = 0;
                foreach ($_POST['code'] as $code) {
                    $code = trim($code);
                    $allowTimeUsed = 1;
                    $validFrom = null;
                    $validUntil = null;
                    $model = new CouponCode();
                    $result = $model->getModelInstance()
                        ->set('partnerUuid', $partnerUuid)
                        ->set('clientUuid', $clientUuid)
                        ->set('couponUuid', $couponUuid)
                        ->set('code', $code)
                        ->set('codeHash', hex2bin(md5($code))) // convert from hex string to bin16
                        ->set('isDeliverd', 0)
                        ->set('timeUsed', 0)
                        ->set('allowTimeUsed', $allowTimeUsed)
                        ->set('validFrom', $validFrom)
                        ->set('validUntil', $validUntil)
                        ->create();
                    if ($result) {
                        $count++;
                    }
                    $model = null;
                }
                $this->set('count', $count);
                return $this->render('importFinish');
            }

        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, sprintf('错误: %s', $e->getMessage()), null, null);
        }
    }


    public function export()
    {

    }

    /**
     * 自动生成优惠券
     *
     */
    public function auto()
    {
        try{
            $couponUuid = $this->_getRequired('couponUuid'); // string
            $this->set("couponUuid", $couponUuid);

            $coupon = $this->coupon->loadByPrimaryKey(hex2bin($couponUuid))->toArray();
            $clientUuid = bin2hex($coupon['clientUuid']);
            $this->set('clientUuid', $clientUuid);

            if (isset($_POST['submit'])){
                $request = $_REQUEST;
                // Add partner Uuid
                $partnerUuid = $this->_getUserFromSession('partnerUuid'); // bin
                $request['partnerUuid'] = bin2hex($partnerUuid); // binary
                $this->_addCouponCode($request);
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);

        }
    }

    /**
     * Search coupon code
     */
    public function search()
    {
        $couponUuid = $this->_getRequired('couponUuid');
        $couponCode = trim($this->_getRequired('couponCode'));
        $model = new CouponCode();
        $r = $model->search($couponCode, $couponUuid);
        if (count($r) == 0) {
            // not found
            $this->_addMessagebox(Alert::TYPE_DANG, sprintf('%s 没有找到！', $couponCode), null, null);
            $this->index();
            $this->render('index');
            return;
        }
        // found
        // 定义value过滤
        $uuidFilters = new Coupon\UI\Filter\Uuid(array('partnerUuid','clientUuid','couponUuid','codeHash','uuid'));
        $this->set("codes", $r)
            ->set('coupon', $this->coupon->loadByPrimaryKey(hex2bin($couponUuid))->toArray())
            ->set('hiddenColumns', array('couponUuid','codeHash','partnerId'))// 定义隐藏列
            ->set('valueFilter', $uuidFilters->getFilter());
    }

    /**
     * 浏览某个优惠卷号码
     *
     */
    public function view()
    {
        $this->setPageTitle("察看新优惠券号码");

        $couponCodeHash = $this->_getRequired('codeHash');
        $clientUuid = $this->_getRequired('clientUuid');
        $m = new CouponCode();
        $couponCode = $m->findByCouponCodeHash($couponCodeHash, $clientUuid);
        if (count($couponCode) !== 1) {
            throw new Exception("");
        }
        $couponCode = array_shift($couponCode);


        // 定义key翻译
        $translate = new Columns();
        $translate->setMapping($this->_translate);

        // 定义值过滤器
        $filter = $this->_getFilter();
        $filter->addMapping('isDeliverd', self::_getIsDeliveredFilter());

        $this->set('data', $couponCode)
            ->set('valueFilter', $filter)
            ->set('keyTranslator', $translate);


    }

    /**
     * Add coupon code
     * @param array $request
     */
    private function _addCouponCode(array $request)
    {
        $model = new CouponCode();
        $count = $model->add($request);
        if ($count > 0) {
            $this->_addMessagebox(Alert::TYPE_SUCC, sprintf('成功添加了%d个优惠券代码.', $count), '/partner/coupon', '返回');
        } else {
            $this->_addMessagebox(Alert::TYPE_DANG, '失败！', null, null);
        }
        return;
    }

}
/* EOF */