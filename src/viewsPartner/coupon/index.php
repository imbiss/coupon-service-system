<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">所有优惠券</h1>
            </div>
        </div>

        <?=$this->renderElement('Notifications');?>
        <?=$this->renderElement('Table/Standard', array('data'=>$results))?>

        <div >
            <?=$this->renderElement('Pagination', array('pagination'=>$pagination));?>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <a href="/partner/coupon/add" class="btn btn-primary">添加新优惠券种类</a>
            </div>
        </div>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>
</div>