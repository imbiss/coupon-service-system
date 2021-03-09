<?php
use \Outlet\UI\Alert;
use \Coupon\Controller\Partner;
use Coupon\Translator\Columns;
use Coupon\Filter\ColumnValue;
use Coupon\Model\Client;

class terminalController extends Partner
{

    public $uses = array('client');

    public $helpers = array('url', 'form');


    private $_translate = array(
        'uuid' => '终端标示',
        'partnerUuid' => '客户标示',
        'created' => '创建',
        'lastmodify' => '最后修改',
        'name' => '名字',
        'description' => '描述',
        'countCoupon' => '已绑定的优惠券',
        'status' => '状态',
    );

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * List all coupon
     *
     */
    public function index()
    {
        try {
            $this->setPageTitle('销售终端列表');
            $partnerUuid = $this->_getUserFromSession('partnerUuid');

            // 定义翻译列名
            $translate = new Columns();
            $translate->setMapping($this->_translate);


            // 定义附加列
            $extraColumn = new Coupon\View\Table\Column();
            $extraColumn->title = "操作";
            $extraColumn->tpl = 'Partner/TerminalButtonLink';

            // 定义列值过滤器
            $filter= new ColumnValue();
            $filter->addMapping('status', parent::_getStatusFilter());

            //定义隐藏列
            $hiddenColumns = array('uuid', 'partnerUuid', 'partnerAddress', 'partnerActive', 'partnerCreated', 'partnerLastmodify');


            $m = new Client;
            $clients = $m->fetchByPartnerUuid($partnerUuid);

            $this->set('results', $clients) // 列出该用户的所有销售端
                ->set('extraColumnsTpl', 'ClientButtonLink')
                ->set('hiddenColumns', $hiddenColumns) // 定义隐藏列
                ->set('columnsTranslator', $translate)
                ->set('extraColumns', array($extraColumn))
                ->set('columnsFilter', $filter);
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }
    }

    /**
     * view detail of a client
     * @
     */
    public function more()
    {
        $this->setPageTitle('客户端详细');

        // 定义key翻译
        $translate = new Columns();
        $translate->setMapping($this->_translate);

        // 定义value过滤
        $uuidFilter = function($bin, $key, $list) {
            return bin2hex($bin);
        };

        $couponCountLink = function($count, $key, $list) {
            if (intval($count) < 1) {
                return '';
            }
            //$uuid = bin2hex($list['uuid']);
            //$link = sprintf("/partner/coupon/?clientUuid=%s", $uuid);
            return sprintf("<a href=\"/partner/coupon/\">%s</a>", $count);
        };

        $filter= new ColumnValue();
        $filter->addMapping('uuid', $uuidFilter)
            ->addMapping('partnerUuid', $uuidFilter)
            ->addMapping('countCoupon', $couponCountLink)
            ->addMapping('status', parent::_getStatusFilter());


        $m = new Coupon\Model\Client();
        $uuid = $this->_getRequired('uuid');// client UUID in string
        $this->set('client', $m->getWithCouponCount($uuid))
             ->set('keyTranslator', $translate)
             ->set('valueFilter', $filter);
    }


    /**
     * Request a new client
     *
     */
    public function request()
    {
        try{
            $this->setPageTitle('申请新客户端');
            if (isset($_POST['submit'])) {
                $name = $this->_getRequired('name');
                $description = $this->_getRequired('description');
                if (empty($name) || empty($description)) {
                    throw new Exception("名字和描述的内容不能为空。");
                }
                $user = $this->_getUserFromSession();
                $partnerUuid = $user['partnerUuid'];

                $m = new Coupon\Model\Client();
                $model = $m->getModelInstance();
                $model->set('name', $name)
                    ->set('description', $description)
                    ->set('partnerUuid', $partnerUuid)
                    ->set('status', \client::STATUS_PENDING);
                $requestData = $model->toArray();
                $r = $m->add($requestData);
                if ($r == '0') {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
                }
            }
        } catch (Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }

    }






}
/* EOF */