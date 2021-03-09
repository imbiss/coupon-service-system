<?php

?>
    <form role="form" method="post" action="/partner/tools/redemptionlog">

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

        <button class="btn btn-primary" type="submit" name="submit" value="submit">
            查询
        </button>
    </form>
