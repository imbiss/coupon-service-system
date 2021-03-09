<?php
/**
 * 显示admin partner 里面2个<a>操作按钮列
 */


// closures (need > php5.3)
$callback = function($row){
    return sprintf(" onclick=\"return confirm('确认删除?');\" ", null);
};

// 0: 显示名字， 1: 链接模版, 2:模版参数数组, 3: <a> 一个回调函数，
$links = array(
    array("编辑", '/admin/partner/edit?id=%s', array('id') ),
    array("删除", '/admin/partner/delete?id=%s', array('id'), $callback),

);

echo $this->renderElement('Table/Column/ButtonList', array('links'=>$links, 'row'=>$row));