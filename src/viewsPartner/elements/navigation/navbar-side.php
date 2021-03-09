<?php

// Level 3

// Level 2
$submenuCoupons = new Coupon\UI\Menu(array('id'=>'side-menu-2'));

/**
$submenuItemCoupon = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/coupon"><i class="fa fa-bar-chart-o fa-fw"></i>优惠券<span class="fa arrow"></span></a>',
        'child' => null
    )
);

$submenuItemCouponCode = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/couponcode"><i class="fa fa-bar-chart-o fa-fw"></i>优惠券号码 <span class="fa arrow"></span></a>',
        'child' => null
    )
);
$submenuCoupons->addItem($submenuItemCoupon)
    ->addItem($submenuItemCouponCode);
*/
$submenuItemTools = new Coupon\UI\MenuItem(
    array(
        'content' => 'xx',
        'child' => null
    )
);

// Level 1
$menu = new Coupon\UI\Menu(array('id'=>'side-menu'));
$itemSearch = new Coupon\UI\MenuItem(
    array(
        'styleClassName'=>'sidebar-search',
        'icon' => '',
        'content' => $this->renderElement('navigation/side-menu/searchform'),
        'child' => null
    )
);
$itemDashboard = new Coupon\UI\MenuItem(
    array(
        'styleClassName'=>'',
        'icon'=>'',
        'content'=> '<a class="active" href="/partner/dashboard"><i class="fa fa-dashboard fa-fw"></i> 仪表盘 </a>',
        'child'=>null
    )
);
$itemCoupon = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/coupon"><i class="fa fa-bar-chart-o fa-fw"></i> 优惠券管理 <span class="fa arrow"></span></a>',
        'child' => array()
    )
);

$itemClient = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/terminal"><i class="fa fa-bar-chart-o fa-fw"></i> 销售终端 <span class="fa arrow"></span></a>',
        'child' => null
    )
);


$itemTools = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/tools"><i class="fa fa-bar-chart-o fa-fw"></i>工具 <span class="fa arrow"></span></a>',
        'child' => array()
    )
);

$itemApiTools = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/apitools"><i class="fa fa-bar-chart-o fa-fw"></i>API工具 <span class="fa arrow"></span></a>',
        'child' => null
    )
);

$itemReport = new Coupon\UI\MenuItem(
    array(
        'content' => '<a href="/partner/report"><i class="fa fa-bar-chart-o fa-fw"></i>报表<span class="fa arrow"></span></a>',
        'child' => null
    )
);


$menu//->addItem($itemSearch)
     //->addItem($itemDashboard)
     ->addItem($itemClient)
     ->addItem($itemCoupon)
     ->addItem($itemTools);
     //->addItem($itemReport);
     //->addItem($itemApiTools);


?>
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
       <?=$this->renderElement('navigation/side-menu/menu', array('menu'=> $menu, 'level'=>0));?>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->