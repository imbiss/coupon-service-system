<?php
/**
 * 显示3个<a>操作按钮列
 */
$lnk = null;
$text = null;

$lnkDelete = null;
$textDelete = null;

// closures (need > php5.3)
$callback = function($row){
    return sprintf(" onclick=\"return confirm('会同时删除%s的所有优惠券代码。确认删除?');\" ", $row['name']);
};

// 0: 显示名字， 1: 链接模版, 2:模版参数数组, 3: <a> 一个回调函数，
$links = array(
    array("编辑", '/partner/coupon/edit?uuid=%s', array('uuid') ),
    array("删除", '/partner/coupon/delete?uuid=%s', array('uuid'), $callback),
    array('优惠码','/partner/couponcode/?couponUuid=%s', array('uuid'))

);

echo $this->renderElement('Table/Column/ButtonList', array('links'=>$links, 'row'=>$row));