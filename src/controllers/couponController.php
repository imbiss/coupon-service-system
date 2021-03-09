<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-16
 * Time: 上午12:04
 */
use Coupon\Validator\Partner as PartnerValidator;
use Coupon\Model\Coupon as Coupon;
use Coupon\Translator\Columns;
use Coupon\Filter\ColumnValue;


use Outlet\UI\Alert;


class couponController extends \Coupon\Controller\Admin
{

    public $uses = array('partner', 'coupon');

    public $helpers = array('url', 'form');

    private $_translate = array(
        'validDateInterval' => '有效期',
        'count' => '优惠码数量',
        'clientName' => '适用于客户端',
        'created' => '创建',
        'lastmodify' => '最后修改',
        'firma_name' => '公司名',
        'name' => '名称',
        'couponValue' => '面值',
        'partnerName'=>'公司',
        'partnerActive' => '公司状态',
        'count_deliverd'=> '发行量',
        'count_used' => '使用量'
    );

    /**
     * 显示所有代金卷
     *
     */
    public function index()
    {
        $this->setPageTitle("所有代金卷");
        $this->set('hiddenColumns', array(
            'uuid',
            'partnerUuid',
            'clientUuid',
            'couponType',
            'partnerId',
            'description',
            'couponUseCondition',
            'created',
            'lastmodify',
            'partnerAddress',
            'partnerCreated',
            'partnerLastmodify'
        ));

        // 定义翻译列名
        $translate = new Columns();
        $translate->setMapping($this->_translate);
        $this->set('columnsTranslator', $translate);

        // column value filter
        $filter= new ColumnValue();
        $this->set('columnsFilter',  parent::_getFilter());


        $m = new Coupon;
        $this->set('coupons', $m->findAllWithCodeCounterAndPagination());
    }

    /**
     * 删除一个coupon
      */
    public function del()
    {
        if (isset($_REQUEST['id'])) {

            return;
        }
        return $this->redirect('/partner');
    }

    /**
     * 添加一个新的代金卷
     *
     *
     */
    public function add()
    {
        try {
            die('此功能不可用。用户需要自行添加优惠卷。');

        } catch (\Exception $e) {
            $this->_addMessagebox('danger',$e->getMessage());
            $this->set('data', $_REQUEST);// display to use input
        }
    }

    /**
     * 修改合作伙伴内容
     *
     */
    public function edit()
    {
        try {

        } catch (\Exception $e) {
            $this->_addMessagebox('danger',"Catch Exception: " . $e->getMessage());
            $this->set('data', $_REQUEST);// display to user last input
        }
    }


}
/* EOF */