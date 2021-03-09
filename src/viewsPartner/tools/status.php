
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">优惠码检查</h1>
                <p>检验一个优惠号码的当前状态。</p>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>


        <div class="row">

            <div class="col-lg-12">
                <?=$this->renderElement('/Form/CouponCodeQuery', array('type'=>'status'));?>
            </div>

            <div class="col-lg-12">


                <?php
                if (isset($validator)) {
                ?>

                    <h2>查询结果</h2>
                <?php
                    $errors = $validator->getErrors();
                    echo ('<P>');
                    printf('优惠码 <strong>%s</strong> 的状态是:<mark>%s</mark>',
                        $couponCode,
                        (empty($errors)) ? '0' : implode(', ', $errors));
                    echo ('</P>');


                    /**
                     *   const MSG_NOT_VALID_CLIENT = 1;
                    const MSG_NOT_VALID_CODE = 2;
                    const MSG_NOT_VALID_DELIVERED = 3;
                    const MSG_NOT_VALID_ALLOW_TIME_USED = 4;
                    const MSG_NOT_VALID_FROM_UNTIL = 5;
                    const MSG_NOT_VALID_CODE_CONFLICT = 6; // more coupon with same code found in one client
                    const MSG_NOT_VALID_CODE_HASH_CRASH = 7; // same hash?
                     */
                        $status = array(
                            'Status' => 'Description',
                            '0' => '休眠中(该号码尚未被发布)',
                            '1' => '使用该号码的终端无效',
                            '2' => '无效的号码',
                            '3' => '号码正确且已公开或发送',
                            '4' => '超过使用次数限制',
                            '5' => '超出使用期限限制',
                            '6' => '该客户端存在多个相同的号码',
                            '7' => '哈希冲突。找到一个具有相同哈希值的不同号码',
                            );
                        echo $this->renderElement('List/Table', array('list'=> $status));
                    }
                ?>



            </div>
        </div>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>