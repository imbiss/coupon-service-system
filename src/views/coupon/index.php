<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array('activeItem' => 'partner'));
$cn = "coupon"; // controller name
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <div class="page-header">
            <h2>所有代金卷
                <?php printf('<small>共%d个记录</small>', count($coupons)); ?>
            </h2>
        </div>




        <div style="margin-bottom: 1em;">
            <a href="<?=$url->g('coupon','add',array());?>" class="btn btn-primary " role="button">
                <span class="glyphicon glyphicon-plus "></span>
                添加
            </a>
        </div>



        <?php
            if(count($coupons) > 0) {
        ?>
            <div class="table-responsive">
        <?php
            echo \Coupon\View\Switcher::toPartner($this)->renderElement('Table/Standard', array('data'=>$coupons));
        ?>
            </div>
        <?php
        } else {
        ?>
            <p>没有记录</p>
        <?php
        }
        ?>

    </div>
<?php
echo $this->renderElement('footer', array());
?>