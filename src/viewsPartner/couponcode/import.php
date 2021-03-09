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
        <p>
            倒入文件为CSV格式．编码必须为UTF-8.如果有多列，第一列必须是优惠码．列分割符为;. 每行只含有一个优惠码．优惠码不能有重复．
        </p>
        <form method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <label>CSV文件</label>
                <input type="file" id="couponCodeFile" accept=".csv" name="couponcode">
            </div>

            <button type="submit" class="btn btn-default" name="preview" value="preview">预览</button>
            <input type="hidden" name="couponUuid" value="<?=bin2hex($coupon['uuid']);?>" />
        </form>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>