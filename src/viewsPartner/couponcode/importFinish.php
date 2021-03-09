<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">批量导入<?=$coupon['name'];?></h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <p>导入<?=$count;?></p>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>