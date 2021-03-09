<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i><?=$coupon['name'];?></i>的号码管理</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?=$this->renderElement('Notifications');?>

        <div class="row">
            <div class="col-lg-12">
                <a href="/partner/couponcode/add?couponUuid=<?=bin2hex($couponUuid);?>" class="btn btn-default" role="button" >
                   手动添加
                </a>
                <a href="/partner/couponcode/auto?couponUuid=<?=bin2hex($couponUuid);?>" class="btn btn-default" role="button" >
                    自动生成
                </a>

                <a href="/partner/couponcode/import?couponUuid=<?=bin2hex($couponUuid);?>" class="btn btn-default" role="button" >
                    批量导入 (test)
                </a>
            </div>
        </div>

        <br>

        <div class="row col-lg-12">
            <form action="/partner/couponcode/search" method="post" role="form" class="form-inline" >
            <div class="form-group">

                <input type="hidden" name="couponUuid" value="<?=bin2hex($couponUuid);?>" />
                <input type="text" name="couponCode" placeholder="优惠卷号码"  class="form-control" />
                <button type="submit" name="submit" value="submit" class="form-control">
                    Search
                </button>

            </div>
            </form>
        </div>

        <br>
        <br>

        <?=$this->renderElement('Table/Standard', array('data'=>$codes))?>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>