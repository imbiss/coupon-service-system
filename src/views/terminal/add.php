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

    <?=$this->renderElement('../../viewsPartner/elements/Notifications');?>

    <div class="page-header">
        <h2><?= ('edit' == $type) ? '编辑' : '添加'; ?>销售终端</h2>
    </div>

    <div id="page-wrapper">
        <?=$this->renderElement('Editor/Terminal', array('type'=>$type));?>
    </div>

</div>