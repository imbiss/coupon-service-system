<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>
    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>



        <div class="row">
            <?=$this->renderElement('Notifications');?>
            <div class="col-lg-12">
                <h2>检验</h2>

                <h2>参数表</h2>
                <?php
                $apiInfo = array(
                    'description' => 'Validate a coupon code by given partner Uuid, Client Uuid, coupon code hash and checksum.',
                    'method' => "GET",
                    'url' => '/CV/{partnerUuid}/{clientUuid}/{codeHash}/{checksum}',
                    'return' => 'JSON Array'
                );
                echo $this->renderElement('List/Table', array('list'=>$apiInfo));
                ?>

                <?php
                    if (isset($result)) {
                        if (count($result) > 0) {
                            echo $this->renderElement('List/Table', array('list'=>array_shift($result)));
                        } else {
                ?>
                    <p>没有找到</p>
                <?php
                        }
                    }
                ?>

                <form role="form" method="post" action="/partner/tools/validate">

                    <div class="form-group">
                        <label>选择客户端</label>
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
            </div>
        </div>












    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>