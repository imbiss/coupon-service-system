<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-18
 * Time: 下午3:32
 */

/* @var $message Outlet\UI\Alert */
foreach($messages as $message) {
    echo $message->render();
}
/* EOF */