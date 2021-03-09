<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-10-4
 * Time: 下午5:02
 */
use Coupon\Controller\Admin;
use Outlet\UI\Alert;
use Coupon\Model\Coupon;

class testshopController extends Admin
{

    public $helpers = array('url', 'form');

    public function index()
    {
        try {
            $this->setPageTitle('测试商店');
            $m = new Coupon;
            $this->set('coupons', $m->findAllInPair());
            //throw new \Exception("test");
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage());
        }
    }


    public function obtainCoupon()
    {
        try{
            $connection = $this->_getRequired('connection');
            $couponUuid = $this->_getRequired('couponUuid');
            $this->set('connection', $connection)
                ->set('couponUuid', $couponUuid);
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage());
        }
    }
}