<!-- Static navbar -->
<?php
/**
 *
 *
 */
if (!isset($activeItem)){
    $activeItem = "home";
}

if (!isset($url)) {
    throw new \Exception('Need to use URL helper.');
}

function isActive($name, $activeItem) {
    return ($name == $activeItem) ? 'active' : '';
}
?>
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="<?=$url->g('main','index',array())?>">coupon-service.com</a>-->
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown <?=isActive('outlet', $activeItem);?>">
                    <a href="/admin/terminal" class="dropdown-toggle" data-toggle="dropdown" >销售终端<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/terminal">全部</a></li>
                    </ul>
                </li>



                <li class="dropdown <?=isActive('partner', $activeItem);?> ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">合作伙伴<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$url->g('partner')?>">全部</a></li>
                        <!--
                        <li><a href="<?=$url->g('');?>">xxx</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                        -->
                    </ul>
                </li>

                <li class="dropdown <?=isActive('product', $activeItem);?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">代金卷<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$url->g('coupon')?>">全部</a></li>
                    </ul>
                </li>

                <li class="dropdown <?=isActive('product', $activeItem);?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">结算<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=$url->g('accounting')?>">全部</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- <li><a href="/admin/piwigo" target="_blank">相册</a></li> -->
                <li class="active"><a href="<?=$url->g('log');?>">Log</a></li>
                <li><a href="#">Fixed top</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>