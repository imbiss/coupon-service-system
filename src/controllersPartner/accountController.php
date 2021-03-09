<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */

class accountController extends \Outlet\Controller\Partner
{
    //public $uses = array("");
    public $components = array("Session");



    public function index()
    {
        $this->redirect("/partner/login");
    }




    public function edit()
    {

    }


    public function settings()
    {

    }


    public function profile()
    {

    }

}
/* EOF */