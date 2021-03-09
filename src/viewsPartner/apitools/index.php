<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <?=$this->renderElement('Notifications');?>
            <div class="col-lg-12">
                <h1 class="page-header">工具</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <div class="row">
            <ul>
                <li><a href="/partner/tools/getCode">获取新号码</a></li>
                <li><a href="/partner/tools/validate">查询号码</a></li>
                <li><a href="/partner/tools/distribute">发送优惠券代码</a></li>
                <li><a href="/partner/tools/redemption">赎回</a></li>
            </ul>
        </div>









        <?=$this->renderElement('Notifications');?>






    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>