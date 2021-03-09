<?php

$paneHeading = "";
$buttonText = "";
$coupon =  isset($coupon) ? $coupon : array();
$action = "";

if (!isset($clients) || empty($clients)) {
    die("No client, set client first.");
}

switch ($type) {
    case 'add' :
        $paneHeading = "添加一个新的优惠券";
        $buttonText = "添加";
        $action = "add";
        break;

    case 'edit':
        $paneHeading = "编辑优惠券";
        $buttonText = "保存";
        $action = "edit";
        break;

    default:
        break;
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?=$paneHeading;?></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" method="post" action="/partner/coupon/<?=$action?>">
                            <?php
                                if ($type=='edit') {
                                    $coupon['uuid'] = bin2hex($coupon['uuid']); // convert bin 2 hex
                            ?>
                                    <input type="hidden" name="uuid" <?=$form->value('uuid', $coupon); ?>" />
                            <?php
                                }
                            ?>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#basic" role="tab" data-toggle="tab">基本</a></li>
                                <li><a href="#cost" role="tab" data-toggle="tab">费用</a></li>
                            </ul>


                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="basic">

                                    <div class="form-group" style="margin-top:20px;">
                                        <?php
                                            if ($type == 'edit') {
                                        ?>
                                            <label>UUID</label>
                                            <input type="input" <?= $form->value('uuid', $coupon); ?> readonly class="form-control" />
                                        <?php
                                            }
                                        ?>

                                        <label>终端</label><?=($isAlreadyDelivered)?' (锁定)':'';?>
                                        <select name="clientUuid" class="form-control" <?=($isAlreadyDelivered ? ' readonly ': ''); ?> >
                                            <?php
                                            foreach($clients as $client) {
                                                printf("<option value=\"%s\" %s>%s</option>",
                                                    $client['uuid'],
                                                    $form->selected('clientUuid', $coupon, $client['uuid']),
                                                    $client['name']);
                                            }
                                            ?>
                                        </select>
                                        <p class="help-block">代金券仅能在指定客户端使用.
                                         注意:一旦有优惠券号码对外发布了，就不再可修改客户端了。</p>
                                    </div>

                                    <div class="form-group">
                                        <label>名称</label>
                                        <input class="form-control" name="name" <?=$form->value('name', $coupon);?>>
                                        <p class="help-block">比如 圣诞大酬宾，立减10欧.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>简短描述</label>
                                        <input class="form-control" name="shortDescription" <?=$form->value('shortDescription', $coupon);?> >
                                    </div>


                                    <div class="form-group">
                                        <label>详细描述</label>
                                        <textarea rows="3" class="form-control" name="description"><?=$form->text('description', $coupon,'');?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>类型</label>
                                        <select class="form-control" name="couponType">
                                            <option value="1">固定面值</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>价值</label><?=($isAlreadyDelivered)?' (锁定)':'';?>
                                        <input class="form-control" name="couponValue" <?=$form->value('couponValue', $coupon, '');?> <?=($isAlreadyDelivered ? ' readonly ': ''); ?>>
                                        <p class="help-block">注意:一旦有优惠券号码对外发布了，价格就不再可修改了。</p>
                                    </div>

                                    <div class="form-group">
                                        <label>货币</label>
                                        <select class="form-control" name="couponCurrency" <=$form->value('couponCurrency', $coupon, '');?> >
                                            <option>EUR (欧元)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>有效期</label>
                                        <select class="form-control" name="validDateInterval">
                                            <?php
                                                $opt = array(
                                                    'P7D' => '1周',
                                                    'P14D' => '2周',
                                                    'P21D' => '3周',
                                                    'P1M' => '1个月',
                                                    'P2M' => '2个月',
                                                    'P3M' => '3个月',
                                                    'P6M' => '6个月',
                                                    'P12M' => '12个月',
                                                    'P24M' => '24个月',
                                                    'P100Y' => '100年',
                                                );
                                                echo $form->options($opt, $coupon['validDateInterval']);
                                            ?>
                                        </select>
                                        <p class="help-block">从分发之日开始</p>
                                    </div>


                                    <div class="form-group">
                                        <label for="minimumValueId">最低消费限制</label>
                                        <input id="minimumValueId" type="text" name="minimumValue" <?=$form->value('minimumValue', $coupon,''); ?> class="form-control" placeholder="比如 50.00">
                                        <p class="help-block">留空表示没有限制</p>
                                    </div>

                                    <div class="form-group">
                                        <label>客户自定以回叫参数</label>
                                        <textarea class="form-control" name="customCallbackParameter"><?=$coupon['customCallbackParameter'];?></textarea>
                                        <p class="help-block">该参数会发还给调用者</p>
                                    </div>


                                    <!--
                                    <div class="form-group">
                                        <label>消费限制参数(not used)</label>
                                        <input class="form-control" >
                                        <p class="help-block">该参数与消费限制类型有关。</p>
                                    </div>
                                    -->

                                    <!--
                                    <div class="form-group">
                                        <label>库存警告线(not used)</label>
                                        <input class="form-control">
                                        <p class="help-block">当库存的优惠券代码不足该数值时，会发出警告。0为不发出警告。</p>
                                    </div>
                                    -->

                                    <!--
                                    <div class="control-group">
                                        <label for="date-picker-3" class="control-label">活动开始日期</label>
                                        <div class="controls">
                                            <div class="input-group input-append date form_datetime ">
                                                <label for="date-picker-3" class="input-group-addon btn">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </label>
                                                <input id="date-picker-3" type="text" class="form-control" name="activeFrom" <?=$form->value('activeFrom', $coupon);?>/>

                                            </div>
                                            <p class="help-block">留空表示不限制。 此有效期是指分发优惠券的时间范围，非优惠码的有效期。</p>
                                        </div>

                                    </div>


                                    <div class="control-group">
                                        <label for="date-picker-3" class="control-label">活动结束日期</label>
                                        <div class="controls">
                                            <div class="input-group input-append date form_datetime">
                                                <label for="date-picker-3" class="input-group-addon btn">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </label>
                                                <input id="date-picker-3" type="text" class="date-picker form-control" name="activeUntil" <?=$form->value('activeUntil', $coupon);?> />
                                            </div>
                                            <p class="help-block">留空表示不限制。</p>
                                        </div>
                                    </div>
                                    -->
                                </div><!-- tab basic end -->

                                <div class="tab-pane" id="cost">
                                    <p style="margin-top:20px;">
                                        这里显示与coupon-service.com的结算方法。具体内容参见服务合同。
                                    </p>
                                    <?php
                                        $costList = array(
                                            'costType' => $coupon['costType'],
                                            'costValue' => $coupon['costValue'],
                                            'costCurrency' => $coupon['costCurrency']
                                        );

                                        echo $this->renderElement('List/Table', array('list' => $costList));
                                    ?>
                                </div>
                            </div><!-- tab content end -->


                            <button class="btn btn-primary" type="submit" name="submit" value="submit">
                                <?=$buttonText;?>
                            </button>

                            <p class="help-block">创建后可以添加优惠码。一旦优惠码发出后部分属性将无法编辑。</p>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss"
    });
</script>