<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */
use Outlet\BI\Login as LoginLogic;
use Coupon\Controller\Partner;

class logoutController extends Partner
{


    /**
     * Use BI logic to logout.
     *
     */
    public function index()
    {
        LoginLogic::Logout($this->Session);

        $this->redirect("/partner?");
    }


}
/* EOF */