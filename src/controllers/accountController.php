<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-9-28
 * Time: 下午11:56
 */
use Coupon\Model\User;
use Outlet\UI\Alert;

class accountController extends \Coupon\Controller\Admin
{
    public $uses = array('partner');
    public $helpers = array('url', 'form');

    /**
     * List user list. If parnterUuid given list only for partner.
     */
    public function index()
    {
        $partnerUuid = null;
        if (isset($_REQUEST['partnerUuid'])) {
            $partnerUuid = trim($_REQUEST['partnerUuid']);
        }
        $m = new User();
        $users = $m->findAllWithPartnerInfo($partnerUuid);
        $this->set('users', $users);

        // 定义隐藏列
        $this->set('hiddenColumns', array('uuid', 'UserUuid', 'partnerUuid', 'PartnerUuid', 'emailhash', 'passwordhash', 'address'));

        // 定义附加列
        $extraColumn = new Coupon\View\Table\Column();
        $extraColumn->title = "操作";
        $extraColumn->tpl = 'Admin/UserListButtons';
        $this->set('extraColumns', array($extraColumn));
    }

    /**
     * Add a new user
     *
     */
    public function add()
    {
        try{
            $partnerUuid = $this->_getRequired('partnerUuid');
            $partnerInfo = $this->partner->loadByPrimaryKey(hex2bin($partnerUuid))->toArray();
            $this->set('editMode', 'add')
                ->set('partnerUuid', $partnerUuid)
                ->set('partnerInfo', $partnerInfo)
                ->set('data', array());

            if (isset($_POST['submit'])) {
                $m = new User();
                $request = $_REQUEST;
                $r = $m->add($request);
                if ($r == '0') {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '成功', null, null);
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, '失败', null, null);
                }
            }
        } catch (\Exception $e) {
            $this->_addMessagebox('danger', $e->getMessage());
        }
    }

    /**
     * Edit a exists user.
     *
     */
    public function edit()
    {
        try{
            $userUuid = $this->_getRequired('userUuid');
            $m = new User();
            $userInfo = $m->getModelInstance()->loadByPrimaryKey(hex2bin($userUuid))->toArray();
            $partnerUUid = $userInfo['partnerUuid'];
            $this->set('editMode', 'edit')
                ->set('data', $userInfo)
                ->set('partnerUuid', bin2hex($partnerUUid));

            if (isset($_POST['submit'])) {
                if ($_REQUEST['password'] !== $_REQUEST['password-repeat']) {
                    throw new \Exception("Password 不符合。");
                }
                $request = $_REQUEST;
                $r= $m->edit($request);
                if ($r == 1) {
                    $lnk = "/admin/account";
                    $lnkText = "回到列表";
                    $this->_addMessagebox(Alert::TYPE_SUCC, "OK", $lnk, $lnkText);
                    $this->set('data', $m->getModelInstance()->loadByPrimaryKey(hex2bin($userUuid))->toArray());
                } else {
                    $this->_addMessagebox(Alert::TYPE_DANG, 'Failed.');
                }
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(
                Alert::TYPE_DANG,
                sprintf("%s , @file: %s, @line: %s" ,
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine())
            );
        }
        $this->render('add');
    }

    /**
     * DELETE a user
     * @return unknown_type
     */
    public function delete()
    {
        try {
            $userUuid = $this->_getRequired('userUuid');
            $m = new User();
            $m->getModelInstance()->del($userUuid);
            $this->_addMessagebox(Alert::TYPE_SUCC, '成功');
            $this->render('index');
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_SUCC, $e->getMessage());
        }
    }
}
/* EOF */