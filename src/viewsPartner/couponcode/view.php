<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">查看优惠卷号码</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <?php
            //var_dump($data);
            if (isset($data) && count($data)>1) {
                echo $this->renderElement('List/Table', array('list'=>$data));
            }
        ?>
    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>