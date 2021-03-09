<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-17
 * Time: 上午12:08
 */

class dashboardController extends \Outlet\Controller\Partner
{


    /**
     * Show the dashboard
     */
    public function index()
    {
        $this->css('/partner/css/plugins/morris/morris-0.4.3.min.css')
             ->css('/partner/css/plugins/timeline/timeline.css');

        $this->set('partner', $this->Session->read('partner'));
        $this->setPageTitle("首页仪表盘");
    }
}
/* EOF */