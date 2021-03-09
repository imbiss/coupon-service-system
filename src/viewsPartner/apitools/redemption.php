<?php

?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <?=$this->renderElement('Notifications');?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <?=$this->renderElement('Notifications');?>
                <h1 class="page-header"></h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>



        <div class="row">
            <div class="col-lg-12">
                <h2>赎回</h2>

                <form >
                    <div class="form-group">
                        <label>使用优惠券</label>
                        <select class="form-control" name="couponUuid">
                            <option value=""></option>
                        </select>
                    </div>


                    <button class="btn btn-primary" type="buttin" name="submit" value="submit">
                        获取代金券号码
                    </button>
                </form>
            </div>
        </div>












    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>