<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array('activeItem' => 'partner'));
$cn = "partner"; // controller name
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <?php
            echo \Coupon\View\Switcher::toPartner($this)->renderElement('Notifications');
        ?>

        <div class="page-header">
            <h2>合作伙伴
                <?php printf('<small>共%d个记录</small>', count($companies)); ?>
            </h2>
        </div>

        <div style="margin-bottom: 1em;">
            <a href="<?=$url->g('partner','add',array());?>" class="btn btn-primary " role="button">
                <span class="glyphicon glyphicon-plus "></span>
                添加
            </a>
        </div>

        <?php
            if (isset($companies) && count($companies) > 0 ) {
                $switcher = new Coupon\View\Switcher($this);
                echo $switcher->switchTo( AppView::PARTNERPATH)->renderElement('Table/Standard', array('data'=>$companies));
            } else {
                print('<p>没有记录</p>');
            }
        ?>
    </div>
<?php
echo $this->renderElement('footer', array());
?>