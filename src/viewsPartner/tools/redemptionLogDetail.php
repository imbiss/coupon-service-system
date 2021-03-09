
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">优惠券使用记录</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <?php
            if (isset($redemptionLog) && is_array($redemptionLog) ) {
                if (count($redemptionLog) > 0) {
                    echo $this->renderElement('List/Table', array('list'=>$redemptionLog));
                } else {
                    print('Not found');
                }
            }
        ?>



    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>