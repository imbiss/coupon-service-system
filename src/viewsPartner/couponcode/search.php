<?php

if (isset($codes) && count($codes) == 1) {
    $codes = array_shift($codes);
    $head = "找到优惠券号码: " . $codes['code'];
    $found = true;
} else {
    $head = '搜索';
    $found = false;
}

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$head;?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?=$this->renderElement('Notifications');?>

        <div class="row">
            <div class="col-lg-12">
        <?php
            if ($found) {
                echo $this->renderElement('List/Table', array('list' => $codes));
            }

            if (isset($coupon)) {
        ?>
             <h2>关于优惠卷: <?=$coupon['name'];?></h2>
        <?php
                echo $this->renderElement('List/Table', array('list' => $coupon));
            };
        ?>
            </div>
        </div>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>


</div>