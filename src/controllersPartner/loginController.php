<?php

use Outlet\BI\Login as LoginLogic;
use Coupon\Controller\Partner;
use Coupon\BL\User\Login;
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */

class loginController extends Partner
{

    public function beforeAction()
    {
        // DO NOT REMOVE!
        // do nothing, just disable the login check in parent::beforeAction;
    }


    /**
     * 显示登录画面和处理登录
     *
     */
    public function index()
    {
        try {
            $this->setPageTitle("Partner Login");
            if (isset($_POST['submit'])
                && ($user = Login::checkLogin($_REQUEST)) ) {
                // Post, login success, write in session.
                $loginInfo = $user;
                Login::doLogin($this->Session, $loginInfo);
                $this->redirect("/partner/dashboard");
                return;
            }
            // Not POST, show login form
            return;
        } catch (\Exception $e) {
            // Validate Exception or Login Failed
            $this->_addMessagebox('danger', $e->getMessage());// display login page with error message.
        }
    }





}
/* EOF */