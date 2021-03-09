<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-18
 * Time: 下午3:32
 */

/* @var $message Outlet\UI\Alert */
if (isset($messages) && is_array($messages)) {
    foreach($messages as $message) {
        echo $message->render();
    }
}
/* EOF */