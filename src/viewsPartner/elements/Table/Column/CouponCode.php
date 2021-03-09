<?php
$lnk = null;
$text = null;

$lnkDelete = null;
$textDelete = null;

$links = array(
    array(
        '浏览',
        '/partner/couponcode/view?codeHash=%s&amp;clientUuid=%s',
        array('codeHash', 'clientUuid')),
);

echo $this->renderElement('Table/Column/ButtonList', array('links'=>$links, 'row'=>$row));