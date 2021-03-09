<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 15/1/7
 * Time: 下午5:24
 */
use Outlet\UI\Alert;
use Coupon\Controller\Admin;
use Coupon\Model\Partner;

class accountingController extends Admin
{


    public function index()
    {
        $this->setPageTitle('账单计算');
        $partner = new Partner();
        $this->set('partner', $partner->getModelInstance()->findAll());

        // 定义附加列
        $extraColumn = new Coupon\View\Table\Column();
        $extraColumn->title = "操作";
        $extraColumn->tpl = 'Admin/AccountingButtons';
        $this->set('extraColumns', array($extraColumn));

    }
}
/* EOF */