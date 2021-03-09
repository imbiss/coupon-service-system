<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">自动生成</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <?=$this->renderElement('Editor/CouponCodeAutoGenerate', array(''));?>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>