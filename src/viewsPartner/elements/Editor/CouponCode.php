<?php
if (!isset($coupon)) {
    $coupon = array();
}
?>
<div class="row">
    <form role="form" method="post" action="/partner/couponcode/<?=$action;?>">
        <input type="hidden" name="couponUuid" value="<?=bin2hex($coupon['uuid']);?>" >

        <div class="form-group">
            <label>优惠券号码</label>
            <input class="form-control" name="couponCode">
            <p class="help-block">号码不能和已经存在的号码冲突</p>
        </div>


        <div class="form-group">
            <label>号码使用次数限制</label>
            <input class="form-control" name="maxTimeUsed" value="1" >
            <p class="help-block">对于一次性优惠券就是1</p>
        </div>


        <div class="control-group">
            <label for="date-picker-3" class="control-label">有效期开始</label>
            <div class="controls">
                <div class="input-group input-append date form_datetime">
                    <label for="date-picker-3" class="input-group-addon btn">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </label>
                    <input id="date-picker-3" type="text" class="date-picker form-control" name="validFrom"  placeholder="<?=date('Y.m.d');?> 00:00:00"/>
                </div>
                <p class="help-block">留空表示不限制。</p>
            </div>
        </div>

        <div class="control-group">
            <label for="date-picker-3" class="control-label">有效期结束</label>
            <div class="controls">
                <div class="input-group input-append date form_datetime">
                    <label for="date-picker-3" class="input-group-addon btn">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </label>
                    <input id="date-picker-3" type="text" class="date-picker form-control" name="validUntil" placeholder="<?=date('Y.m.d');?> 00:00:00" />
                </div>
                <p class="help-block">留空表示不限制。</p>
            </div>
        </div>


        <button class="btn btn-primary" type="submit" name="submit" value="submit">
           添加
        </button>


    </form>
</div>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss"
    });
</script>