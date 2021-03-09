<?php
/***
 * 显示一组在表格内的按钮。
 * 添加一组链接。行row为参数。links为模版数组
 *
 *
 */
if (isset($row)){
    // a each button link
    // link[0] The name
    // link[1] The link pattern
    // link[2] The parameter list
    foreach($links as $link) {
        $text = $link[0];
        $linkPatten = $link[1];
        $paramList = $link[2];

        // build a parameter array by the value from this row.
        $param = array();
        foreach($paramList as $name) {
            $param[] = $row[$name]; // get the real parameter values
        }
        // build URL
        $url = vsprintf($linkPatten, $param);
        ?>
        <a href="<?=$url;?>" class="btn btn-default" <?=(isset($link[3]) ? $link[3]($row) : '');?> >
            <?=$text;?>
        </a>
    <?php
    }
}
?>