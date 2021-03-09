<?php

?>
    <form role="form" method="get" action="/partner/tools/status">

        <div class="form-group">
            <label>选择销售终端</label>
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
            <label>优惠券号码</label>
            <input type="text" name="couponCode" class="form-control" >
        </div>


        <button class="btn btn-primary" type="submit" name="submit" value="submit">
            查询
        </button>
    </form>
