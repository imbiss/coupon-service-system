<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>



    <div id="page-wrapper">

        <div class="row">
            <?=$this->renderElement('Notifications');?>
            <div class="col-lg-12">
                <h1 class="page-header">发布一个代金卷号码</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>



        <div class="row">
            <div class="col-lg-12">
                <p>
                    通知服务器把某个代金卷设为已发送状态。可选参数是客户信息供记录之用。
                </p>
                <?php
                    if (isset($data) && count($data)>1) {
                        echo $this->renderElement('List/Table', array('list'=>$data));
                    }
                ?>

                <h2>参数表</h2>
                <?php
                $params = array(
                    "partnerUuid" => 'partnerUuid',
                    'clientUuid' => 'clientUuid',
                    'couponCode' => 'coupon code',
                    'customerFirstName' => '(optional) customer first name',
                    'customerLastName' => '(optional) customer last name',
                    'customerEmail' => '(optional) customer email',
                    'customerSalutation' => '(optional) customer email'
                );
                $apiInfo = array(
                    'description' => 'distribute a coupon code to customer.',
                    'method' => "POST",
                    'url' => '/S',
                    'parameter' => $this->renderElement('List/Table', array('list'=>$params)),
                    'return' => 'JSON Array'
                );
                echo $this->renderElement('List/Table', array('list'=>$apiInfo));
                ?>


                <form action="/partner/tools/redemption" method="post" >
                    <div class="form-group">
                        <label>选择优惠券</label>
                        <select class="form-control" name="couponUuid">
                            <?=$form->options($coupons, null);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>号码</label>
                        <input type="text" name="couponCode" value="" />
                        <p>自动选取一个，并记录个人信息，把该号码标记为已经</p>
                    </div>




                    <button class="btn btn-primary" type="submit" name="submit" value="submit">
                      发送。
                    </button>
                    <p class="help-block">每次点击，从最新100个中随机选取1个。</p>
                </form>
            </div>
        </div>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>