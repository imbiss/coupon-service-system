<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14/11/5
 * Time: 下午4:28
 */

// closures (need > php5.3)
/*$callback = function($row){
    if (true){
        return sprintf(" onclick=\"alert('just test'); return false;\" ", null);
    }

};*/
// 0: 显示名字， 1: 链接模版, 2:模版参数数组, 3: <a> 一个回调函数，
$links = array(
    array("详细内容", '/partner/tools/redemptionLogDetail?id=%s', array('id')),
);

echo $this->renderElement('Table/Column/ButtonList', array('links'=>$links, 'row'=>$row));