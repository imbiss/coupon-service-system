<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-3
 * Time: 下午8:13
 */
echo $this->renderElement('navi', array());
?>
<div class="container">
    <h1>成功</h1>
    <?php
    if(isset($successMessage)) {
        echo $successMessage;
    } else {
        printf("<a href=\"%s\">返回</a>", $url->g('auth'));
    }
    ?>
</div>