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

                <?php
                    if (isset($data) && count($data)>1) {
                        echo $this->renderElement('List/Table', array('list'=>$data));
                    }
                ?>

                <h2>参数表</h2>
                <?php
                    $apiInfo = array(
                        'description' => 'Get cooupon code by given partner Uuid, client, checksum.',
                        'method' => "GET",
                        'url' => '/CC/{partnerUuid}/{couponUuid}/{checksum}',
                        'return' => 'JSON Array'
                    );
                    echo $this->renderElement('List/Table', array('list'=>$apiInfo));
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