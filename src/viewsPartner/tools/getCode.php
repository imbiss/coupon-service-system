<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">获取代金券号码</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <div class="row">
            <?=$this->renderElement('Notifications');?>
            <div class="col-lg-12">
                <p>此功能随机选取一个优惠券。</p>
                <?php
                    if (isset($data) && count($data)>1) {
                        echo $this->renderElement('List/Table', array('list'=>$data));
                    }
                ?>

                <form action="/partner/tools/getCode" method="post" >
                    <div class="form-group">
                        <label>选择优惠券</label>
                        <select class="form-control" name="couponUuid">
                            <?=$form->options($coupons, null);?>
                        </select>
                    </div>


                    <button class="btn btn-primary" type="submit" name="submit" value="submit">
                        获取代金券号码
                    </button>
                    <p class="help-block">每次点击，从最新100个中随机选取1个。</p>
                </form>
            </div>
        </div>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>