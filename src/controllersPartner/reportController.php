<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */

class reportController extends \Outlet\Controller\Partner
{
    public $uses = array("deliveryHistory");
    public $components = array("Session");



    public function index()
    {
    }

    /**
     * coupon code delivery report
     */
    public function delivery()
    {
        $this->setPageTitle('显示所有发行记录');
        // Get partner Uuid from session
        $partnerUuid = $this->_getUserFromSession('partnerUuid');
        // list all delivery history by partner uuid
        $r = $this->deliveryHistory->find('all', array('conditions' => array('partnerUuid' => $partnerUuid)));
        $this->set('records', $r);
    }

}
/* EOF */