<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-8-23
 * Time: 下午8:53
 */
class client extends AppModel
{
    public $useTable = 'client';
    public $useIndex = "uuid";

    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_PENDING = 2;

    /**
     *
     * @var array
     */
    protected $_colums = array(
        'uuid', //	int(10)		UNSIGNED	否 	无	AUTO_INCREMENT
        'partnerUuid', //	bin16
        'name', // tiny text utf8
        'description', // text utf8
        'status', // tinyInt
        'created', // datetime
        'lastmodify' // datetime
    );



}
