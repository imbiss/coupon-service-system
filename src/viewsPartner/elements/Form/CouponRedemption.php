<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-10-11
 * Time: 上午12:08
 */
?>
<form role="form" method="post" action="/partner/tools/redemption">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#basic" role="tab" data-toggle="tab">基本</a></li>
        <li><a href="#cost" role="tab" data-toggle="tab">客户信息</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane active" id="basic">

            <div class="form-group">
                <label>选择销售终端＊</label>
                <select class="form-control" name="clientUuid">
                    <?php
                    foreach ($clients as $client) {
                        ?>
                        <option value="<?=$client['uuid'];?>"><?=$client['name'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>需要使用的优惠券号码＊</label>
                <input type="text" name="couponCode" class="form-control" >
            </div>

        </div>

        <div class="tab-pane" id="cost">
            <?php
            $consumerInfo = array(
                array('客户姓','consumerFirstname',''),
                array('客户名', 'consumerLastname', ''),
                array('客户邮件地址', 'consumerEmail', ''),
                array('客户订单标示', 'consumerOrderId', ''),
                array('客户订单价值', 'consumerOrderValue',''),
                array('客户订单货币','consumerOrderCurrency',''),
                array('客户地址','consumerAddress',''),
                array('客户邮编','consumerZipcode',''),
                array('客户电话','consumerPhone',''),
                array('客户Session','consumerSession',''),
            );
            foreach ($consumerInfo as $tmp)
            {
            ?>
                <div class="form-group">
                    <label><?=$tmp[0];?></label>
                    <input type="text" name="<?=$tmp[1];?>" class="form-control" >
                </div>
            <?php
            }
            ?>
        </div>

    </div>

    <button class="btn btn-primary" type="submit" name="submit" value="submit">
          使用
    </button>
</form>