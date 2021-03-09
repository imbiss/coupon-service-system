<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">



        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">编辑</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?=$this->renderElement('Notifications');?>

        <?=$this->renderElement('Editor/Coupon', array('coupon'=>$coupon, 'type'=>'edit'));?>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>
