
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">使用优惠券</h1>
                <p>请选择一个客户端并输入优惠卷号码,并按下使用按钮。你也可以提供客户个人资料已备查询。</p>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>


        <div class="row">

            <div class="col-lg-12">
                <?=$this->renderElement('/Form/CouponRedemption', array());?>
            </div>

            <div class="col-lg-12">

            </div>
        </div>
    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>