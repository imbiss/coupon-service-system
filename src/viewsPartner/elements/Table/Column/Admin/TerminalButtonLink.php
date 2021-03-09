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
    if (intval($row['countCoupon']) > 0){
        return sprintf(" onclick=\"alert('无法删除。请先删除绑定的优惠卷'); return false;\" ", null);
    }

};

// 0: 显示名字， 1: 链接模版, 2:模版参数数组, 3: <a> 一个回调函数，
$links = array(
    array("编辑", '/admin/terminal/edit?uuid=%s', array('uuid') ),
    array("删除", '/admin/terminal/delete?uuid=%s', array('uuid'), $callback),

);

echo $this->renderElement('Table/Column/ButtonList', array('links'=>$links, 'row'=>$row));