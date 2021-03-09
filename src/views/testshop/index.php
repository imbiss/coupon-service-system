<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array('activeItem' => 'partner'));
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <?php
            echo \Coupon\View\Switcher::toPartner($this)->renderElement('Notifications');
        ?>

        <div class="page-header">
            <h2>Test Shop</h2>
        </div>

        <form role="form" action="/admin/testshop/obtainCoupon" methd="post">

            <div class="form-group">
                <label for="coupon">优惠卷/销售终端</label>
                <select class="form-control" id="couponUuid" name="couponUuid">
                    <?php
                        if (isset($coupons)) {
                            foreach($coupons as $uuid => $coupon) {
                    ?>
                                <option value="<?=$uuid;?>" ><?=$coupon?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="coupon">接入方式</label>
                <select class="form-control" id="connection" name="connection">
                    <option value="1">Javascript Client v1</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" value="submit" class="btn btn-primary">
                    获取优惠卷
                </button>
            </div>

        </form>

    </div>
<?php
echo $this->renderElement('footer', array());
?>