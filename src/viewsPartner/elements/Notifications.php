<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-8-7
 * Time: 下午11:19
 */
if (isset($messages)){
    foreach ($messages as $msg) {
        echo $msg->render();
    }
}
?>
