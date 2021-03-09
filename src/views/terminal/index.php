<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array('activeItem' => 'outlet'));
?>
    <div class="container">
        <?=$this->renderElement('Breadcrumbs', array());?>

        <div class="page-header">
            <h2>销售终端</h2>
        </div>

        <div style="margin-bottom: 1em;">
            <a href="/admin/terminal/add" class="btn btn-primary " role="button">
                <span class="glyphicon glyphicon-plus "></span>
                添加
            </a>
        </div>


        <?php
        if(count($clients) > 0) {
            ?>
            <div class="table-responsive">
                <?php
                $switcher = new Coupon\View\Switcher($this);
                echo $switcher->switchTo( AppView::PARTNERPATH)->renderElement('Table/Standard', array('data'=>$clients));
                ?>
            </div>
        <?php
        }else {
            ?>
            <p>没有记录</p>
        <?php
        }
        ?>

    </div>
<?php
echo $this->renderElement('footer', array());
?>