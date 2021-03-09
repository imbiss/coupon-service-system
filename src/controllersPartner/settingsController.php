<?php

use Outlet\BI\Login as LoginLogic;

/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */

class settingsController extends \Outlet\Controller\Partner
{

    public function beforeAction()
    {
        // do not remove this.
        // do nothing, just disable the login check in parent::beforeAction;
        //
    }


    /**
     *  显示用户账号
     *
     */
    public function index()
    {
        try {

            return;
        } catch (\Exception $e) {
            // Validate Exception or Login Failed
            $this->_addMessagebox('danger', $e->getMessage());
        }
        return; // display login page with error message.
    }



}
/* EOF */