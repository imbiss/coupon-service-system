<?php
/**
 * Build a for for coupon code import.
 * For each coupon code will be an line
 */
?>
<div id="wrapper">
    <?=$this->renderElement('navigation', array());?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">批量导入<?=$coupon['name'];?></h1>
            </div>
            <!-- /.col-lg-12 -->

        </div>

        <?=$this->renderElement('Notifications');?>

        <form method="post" role="form" enctype="multipart/form-data">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>代码</th>
                        <th>有效期至</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($codes as $c) {
                ?>
                    <tr>
                        <td><input type="hidden" name="code[]" value="<?=$c[0]?>" /><?=$c[0]?></td>
                        <td><input type="hidden" name="expire[]" value="<?=$c[1];?>" /><?=$c[1];?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>

            <button type="submit" name="importConfirm" value="importConfirm" class="btn btn-primary">导入</button>
        </form>

    </div><!-- page-wrapper end -->
    <?=$this->renderElement('Footer');?>

</div>