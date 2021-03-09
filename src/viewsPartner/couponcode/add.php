<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">手动添加优惠券号码<?=$coupon['name'];?></h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <?=$this->renderElement('Editor/CouponCode', array('type'=>'add'));?>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>