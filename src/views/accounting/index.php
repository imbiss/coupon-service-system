<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */

echo $this->renderElement('navi', array('activeItem' => 'accounting'));

?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <div class="page-header">
            <h2>账单管理</h2>
        </div>

        <?php
            echo \Coupon\View\Switcher::toPartner($this)
                ->renderElement('Table/Standard', array('data'=>$partner));
        ?>
    </div>
<?php
echo $this->renderElement('footer', array());
?>