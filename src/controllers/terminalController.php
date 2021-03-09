<?php
use Outlet\UI\Alert;
use Coupon\Translator\Columns;
use Coupon\Filter\ColumnValue;
use Coupon\Model\Client;
use Coupon\Model\Partner;

class terminalController extends  \Coupon\Controller\Admin
{
    public $uses = array('client', 'partner');
    public $components = array("Session");
    public $helpers = array('url', 'form');



    /**
     * Default index page
     *
     */
    public function index()
    {
        $this->setPageTitle("销售终端管理");

        // 定义附加列
        $extraColumn = new Coupon\View\Table\Column();
        $extraColumn->title = "action";
        $extraColumn->tpl = 'Admin/TerminalButtonLink';
        $this->set('extraColumns', array($extraColumn));

        // 定义隐藏列
        $this->set('hiddenColumns', array(
            'partnerUuid',
            'uuid')
        );

        // 定义列翻译
        $translate = new Coupon\Translator\Columns();
        $translate->setMapping(array(
            'countCoupon' => '绑定代金券数量',
            'created' => '创建',
            'lastmodify' => '修改',
                'status' => '状态'

        ));
        $this->set('columnsTranslator', $translate);


        $m = new Client;
        $this->set('clients', $m->fetchByPartnerUuid(null));


        $filter= new ColumnValue();
        $filter->addMapping('status', parent::_getStatusFilter());
        $this->set('columnsFilter', $filter);
    }


    /**
     * Create  a new client
     */
    public function add()
    {
        $this->setPageTitle("编辑销售终端");
        if (isset($_POST['submit'])) {
            $partnerUuid = $this->_getRequired('partnerUuid');
            $request = $_REQUEST;
            $request['partnerUuid'] = hex2bin($partnerUuid); // bin
            $m = new Client;
            $r = $m->add($request);
            if ($r == '0') {
                $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
            } else {
                $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
            }
        }
        $p = new Partner();
        $this->set('partners', $p->findAllInPair());
        $this->set('type', 'add');
    }

    /**
     * Remove a client
     */
    public function delete()
    {
        $uuid = $this->_getRequired('uuid');
        $r=$this->client->del(hex2bin($uuid));
        if ($r ) {
            $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
        } else {
            $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
        }
        $this->index();
        return $this->render('index');
    }

    /**
     * Edit client list
     *
     */
    public function edit()
    {
        try{
            $this->setPageTitle("编辑销售终端");
            $uuid = $this->_getRequired('uuid'); // client UUID string
            if (isset($_POST['submit'])) {
                $request = $_REQUEST;
                $request['uuid'] = hex2bin($request['uuid']); // bin
                $request['partnerUuid'] = hex2bin($request['partnerUuid']);
                $m = new Client();
                $r = $m->edit($request);
                if ($r ) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功！', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败啊！', null, null);
                }
            }
            $p = new Partner();
            $this->set('partners', $p->findAllInPair());
            $this->set('client', $this->client->loadByPrimaryKey(hex2bin($uuid))->toArray());
            $this->set('type', 'edit');
        }catch(\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }
        $this->render('add');
    }


}
/* EOF */