<?php
/**
 * 一个简单的Auth表
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-16
 * Time: 上午12:05
 */
class auth extends AppModel
{
    public $useTable = 'auth';
    public $useIndex = "id";

    protected $_colums = array(
        'id',   // 	int(10)
        'username', // 	varchar(255),
        'passwordhash' // vchar(512)
    );



}
/* EOF */