<?php

//翻译
$mapping = array(
    'Is delivered' => '是否已经分发',
    'Code' => '优惠卷号码',
    'Valid From' => '有效期开始',
    'Valid Until' => '有效期结束',
    'Coupon Name' => '优惠卷名称'

);
$keyTranslator = new \Coupon\Translator\Columns();
$keyTranslator->setMapping($mapping);

// 值过滤
$valueFilter= new \Coupon\Filter\ColumnValue();
$valueFilter->addMapping('Is delivered', function($value, $colName, $row){
    if ($colName == 'Is delivered') {
        if ($value == '1') {
            return '已分发';
        } else {
            return '未分发';
        }
    }
    return $value;
});


?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>



    <div id="page-wrapper">

        <div class="row">
            <?=$this->renderElement('Notifications');?>
            <div class="col-lg-12">
                <h1 class="page-header">发送一个代金卷号码</h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>



        <div class="row">
            <div class="col-lg-12">
                <p>
                    请输入客户数据，系统会随机选取一个代金卷号码,显示在屏幕上，同时把该优惠卷号码标记为已发送。
                </p>
                <?php
                    if (isset($couponCode)) {
                        $info  =  array(
                            'Coupon Name' => $coupon['name'],
                            'Is delivered' => $couponCode['isDeliverd'],
                            'Code' => $couponCode['code'],
                            'Valid From' => $couponCode['validFrom'],
                            'Valid Until' => $couponCode['validUntil'],
                        );
                        echo $this->renderElement('List/Table', array(
                            'list' => $info,
                            'keyTranslator' => $keyTranslator,
                            'valueFilter' => $valueFilter)
                        );
                    }

                    if (isset($data) && count($data)>1) {
                        echo $this->renderElement('List/Table', array('list'=>$data));
                    }
                ?>

                <form action="/partner/tools/distribute" method="post" >
                    <div class="form-group">
                        <label>选择优惠券</label>
                        <select class="form-control" name="couponUuid">
                            <?php
                                if (isset($coupons)) {
                                    echo $form->options($coupons, null);
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>客户姓(可选)</label>
                        <input type="text" class="form-control" name="customerLastName">
                    </div>

                    <div class="form-group">
                        <label>客户名(可选)</label>
                        <input type="text" class="form-control" name="customerFirstName">
                    </div>

                    <div class="form-group">
                        <label>客户Email(可选)</label>
                        <input type="text" class="form-control" name="customerEmail">
                    </div>

                    <div class="form-group">
                        <label>发送备注(可选)</label>
                        <textarea class="form-control" name="deliveryReason"></textarea>
                    </div>

                    <!--
                    <div class="checkbox">
                        <label class="">
                            <input type="checkbox"  name="noSend" value="noSend" />
                            不要发送，而是显示在屏幕上。
                        </label>
                    </div>
                    -->
                    <input type="hidden" name="noSend" value="noSend" />

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">
                            选取并显示在屏幕上
                        </button>
                    </div>


                </form>
            </div>
        </div>


    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>