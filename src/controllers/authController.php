<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-16
 * Time: 上午12:04
 */
class authController extends  \Coupon\Controller\Admin
{

    public $uses = array('auth');
    public $helpers = array('url', 'form');


    public function index()
    {
        $this->set('users', $this->auth->findAll());
    }


    public function del()
    {
        if (isset($_REQUEST['id'])) {
            $this->auth->del(intval($_REQUEST['id']));
            $this->render("success");
            return;
        }
        $this->redirect('/admin');
    }

    public function add()
    {
        $a = new \Outlet\Model\Auth();
        $req = $_REQUEST;
        $req['passwordhash'] = md5($req['password']);
        unset($req['password']);
        $a->add($req);
        $this->render("success");
    }
}