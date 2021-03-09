<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
$consumerInfo = array('couponUuid' =>$couponUuid);
/**
 * The Javascript client v1
 */
$JsClientUrl = "//coupon.localhost/js/client.js";

echo $this->renderElement('navi', array('activeItem' => 'partner'));
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

    <?php
        echo \Coupon\View\Switcher::toPartner($this)->renderElement('Notifications');
    ?>

    <div class="page-header">
        <h2>获取优惠卷</h2>
    </div>
        <script>
            <!--
            var consumerInfo = <?=json_encode($consumerInfo, true);?>;
            -->
        </script>

        <div id="cuponContainer"></div>
        <script src="<?=$JsClientUrl;?>" data-cotainerId="cuponContainer" data-presentation="layer"></script>
    </div>
<?php
echo $this->renderElement('footer', array());
?>