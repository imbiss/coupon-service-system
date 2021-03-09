<?php
use \Outlet\UI\Alert;
use \Coupon\Controller\Partner;
use Coupon\Translator\Columns;
use Coupon\Filter\ColumnValue;

class couponController extends Partner
{

    public $uses = array('coupon', 'couponCode', 'client');

    public $helpers = array('url', 'form');

    private $_translate = array(
        'validDateInterval' => '有效期',
        'count' => '优惠码(已使用/发送/总数)',
        'clientName' => '适用于销售终端',
        'created' => '创建',
        'lastmodify' => '最后修改',
        'name' => '优惠券名称',
        'firma_name' => '公司名称',
        'costType' => '计费方式',
        'costValue' => '单位价格',
        'costCurrency' => '价格单位',
        'couponType' => '类型',
        'couponValue' => '价值',
        'couponCurrency' => '货币',

    );

    public function __construct()
    {
        parent::__construct();
        $this->addHeaderCSS('/partner/css/bootstrap-datetimepicker.min.css')
             ->addHeaderJS('/partner/js/bootstrap-datetimepicker.min.js');
    }

    /**
     * List all coupon
     *
     */
    public function index()
    {
        try{
            $this->setPageTitle("所有优惠券");
            $partnerUuid = $this->_getUserFromSession('partnerUuid');

            $m = new Coupon\Model\Coupon();
            // @todo list only by partner uuid
            $this->set('results',$m->findAllWithCodeCounterAndPagination(bin2hex($partnerUuid)));

            // 定义隐藏列
            $this->set('hiddenColumns',
                array('uuid',  'firma_name', 'clientUuid', 'count_deliverd', 'count_used',
                    'partnerUuid', 'partnerAddress', 'partnerCreated', 'partnerLastmodify', 'partnerName', 'partnerActive'));

            // 定义翻译列名
            $translate = new Columns();
            $translate->setMapping($this->_translate);
            $this->set('columnsTranslator', $translate);

            // 定义列过滤器
            $callback = function($string, $row) {
                return $string;
            };
            $count = function($string, $colName, $row) {
                return sprintf("%d/%d/%d", intval($row['count_used']), intval($row['count_deliverd']), intval($string));
            };
            $filter= new ColumnValue();
            $filter->addMapping('validDateInterval', $callback) // 翻译时间间隔
                ->addMapping('count', $count);

            $this->set('columnsFilter', $filter);

            // 定义附加列
            $extraColumn = new Coupon\View\Table\Column();
            $extraColumn->title = "操作";
            $extraColumn->tpl = 'CouponButtonLink';
            $this->set('extraColumns', array($extraColumn));
            $this->set('pagination', $m->getPagination());
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
            $this->render("error");
        }
    }


    /**
     * Create  a new coupon
     *
     */
    public function add()
    {
        try{
            $this->setPageTitle("添加新优惠券（种类）");
            $partnerUuid = $this->_getUserFromSession('partnerUuid');
            $this->set('isAlreadyDelivered', false);

            $couponInfo = $this->coupon->init()->toArray(); // get a empty coupon info array.
            $this->set('coupon', $couponInfo);

            if (isset($_POST['submit'])) {
                $request = $_REQUEST;
                $request['partnerUuid'] = $partnerUuid; // binary.  Add FK PartnerUuid
                $model = new Coupon\Model\Coupon();
                $r = $model->add($request);
                if ($r) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
                }
            }
            $m = new Coupon\Model\Client();
            $clients = $m->fetchByPartnerUuid($partnerUuid); // All terminal/client that partner have
            if (empty($clients)) {
                throw new \Exception('No clients found. Please contact admin for new client.');
            }
            $this->set('clients', $clients);
        } catch (Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
            $this->render("error");
        }

    }

    /**
     * Remove a coupon
     */
    public function delete()
    {
        $uuid = $this->_getRequired('uuid');
        $r=$this->coupon->del(hex2bin($uuid));
        if ($r ) {
            $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
        } else {
            $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
        }
        $this->index();
        $this->render('index');
        return;
    }

    /**
     * Edit coupon
     *
     */
    public function edit()
    {
        try{
            $this->setPageTitle("编辑优惠券");
            $isAlreadyDelivered = null;
            $uuid = $this->_getRequired('uuid');// get coupon UUID


            // 检查已经发行的代码数量
            $m = new Coupon\Model\CouponCode();
            $count = $m->getCountByDeliveredStatus($uuid, 1);
            if ($count > 0) {
                $this->_addMessagebox(Alert::TYPE_WARN, sprintf('已经发送出%s个优惠号, 部分属性无法修改！', $count), null, null);
                $isAlreadyDelivered = true;
            } else {
                $isAlreadyDelivered = false;
            }
            $this->set('isAlreadyDelivered', $isAlreadyDelivered);


            if (isset($_POST['submit'])) {
                $model = new Coupon\Model\Coupon();
                $r = $model->edit($_REQUEST);
                if ($r ) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
                }
            }

            // 翻译
            $translate = new Columns();
            $translate->setMapping($this->_translate);
            $this->set('keyTranslator', $translate);

            /*
            $filter= new ColumnValue();
            $filter->addMapping('costType', parent::_getFilter());
            $this->set('valueFilter', $filter);
            */

            // 设置coupon
            $couponInfo = $this->coupon->loadByPrimaryKey(hex2bin($uuid))->toArray();
            $this->set('coupon', $couponInfo);

            // 设置客户端/终端
            $partnerUuid = $this->_getUserFromSession('partnerUuid');
            $m = new \Coupon\Model\Client();
            $clientList = $m->fetchByPartnerUuid($partnerUuid);
            $this->set('clients', $clientList);

        } catch (Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
            $this->set('exception', $e);
            $this->render("error");
        }
    }

    /**
     * List all coupon by given client UUID
     */
    public function client()
    {
       try {
           $clientUuid = $this->_getRequired('uuid', true); // string
       } catch (\Exception $e) {
           $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
           $this->render("error");
       }
    }



}
/* EOF */