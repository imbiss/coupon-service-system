<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-16
 * Time: 上午12:04
 */
use Coupon\Validator\Partner as PartnerValidator;
use Coupon\Model\Partner as Partner;
use Coupon\Model\User as User;
use Outlet\UI\Alert;
use Coupon\Filter\ColumnValue;

class partnerController extends \Coupon\Controller\Admin
{

    public $uses = array('partner', 'user');

    public $helpers = array('url', 'form');



    /**
     * 显示所有合作伙伴
     *
     */
    public function index()
    {
        $this->setPageTitle("所有合作伙伴");

        $m = new Partner();
        $companies = $m->findAllWithAccountCount();
        $this->set('companies', $companies);

        // 定义隐藏列
         $this->set('hiddenColumns', array('uuid'));

        // 定义过滤器
        $buildUserListLnk = function($string, $colName, $row) {
            $retVal = $string;
            if (intval($string) > 0) {
                $lnk = sprintf("/admin/account/index?partnerUuid=%s", $row['uuid']);
                $retVal = sprintf("<a href=\"%s\">%s</a>", $lnk, $string);
            }
            return $retVal;
        };
        $filter= new ColumnValue();
        $filter->addMapping('UserCount', $buildUserListLnk); // 翻译时间间隔
        $this->set('columnsFilter', $filter);

        // 定义附加列
        $extraColumn = new Coupon\View\Table\Column();
        $extraColumn->title = "操作";
        $extraColumn->tpl = 'Admin/PartnerButtons';
        $this->set('extraColumns', array($extraColumn));

    }

    /**
     * 删除一个合作伙伴
     * @return unknown_type
     */
    public function delete()
    {
        if (isset($_REQUEST['uuid'])) {
            $m = new Partner();
            $r = $m->del($_REQUEST['uuid']);
            if ($r) {
                $this->_addMessagebox(Alert::TYPE_SUCC, '成功', null, null);
            } else {
                $this->_addMessagebox(Alert::TYPE_DANG, '失败', null, null);
            }
        }
        $this->index();
        $this->render('index');
    }


    /**
     * Add a new company
     */
    public function add()
    {
        try{
            $this->set('editMode', 'add');
            if (isset($_POST['submit'])) {
                $m = new Partner();
                $r=$m->add($_REQUEST);
                if ($r == 0) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败', null, null);
                }
            }
        } catch (\Exception $e) {
            $this->_addMessagebox('danger',$e->getMessage());
        }
    }

    /**
     *
     */
    public function edit()
    {
        try{
            $this->setPageTitle('修改合作伙伴信息');
            $this->set('editMode', 'edit');
            $uuid = $this->_getRequired('uuid');
            $m = new Partner();
            $data = $m->getModelInstance()->loadByPrimaryKey(hex2bin($uuid))->toArray();
            $data['uuid'] = bin2hex($data['uuid']);
            $this->set('data', $data);
            if (isset($_POST['submit'])) {
                $request = $_REQUEST;
                $request['uuid'] = hex2bin($request['uuid']);// convert hex to bin
                $r=$m->edit($request);
                if ($r) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败', null, null);
                }
            }

        } catch (\Exception $e) {
            $this->_addMessagebox('danger',$e->getMessage());
        }
        $this->render('add');
    }


    /**
     * 修改合作伙伴内容
     *
     */
    public function editAccount()
    {
        try {
            $this->setPageTitle("编辑合作伙伴")
                 ->set('editMode', "edit");

            $request = $_REQUEST;
            $a = new PartnerModel;
            if (isset($_POST['submit'])) {
                if ($result = $a->edit($request)) {
                    $this->_addMessagebox('success', "OK");
                } else {
                    // failed
                   $this->_addMessagebox('danger', "Update failed. (" . $result . ")");
                }
                //$this->redirect("index.php?controller=partner&action=edit&id=". $id);
            }

            // show editor UI
            $id = intval($_REQUEST['id']);
            $this->set('data', $a->getModelInstance()->loadByPrimaryKey($id)->toArray());

        } catch (\Exception $e) {
            $this->_addMessagebox('danger',"Catch Exception: " . $e->getMessage());
            $this->set('data', $_REQUEST);// display to user last input
        }
        return $this->render('add');
    }


}
/* EOF */