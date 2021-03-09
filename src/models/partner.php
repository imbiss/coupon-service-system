<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-9-23
 * Time: 下午11:06
 *
CREATE TABLE IF NOT EXISTS `firma` (
`uuid` binary(16) NOT NULL,
`name` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
`address` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
`active` tinyint(1) DEFAULT NULL,
`created` datetime DEFAULT NULL,
`lastmodiy` datetime DEFAULT NULL,
PRIMARY KEY (`uuid`),
UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 */
class partner extends AppModel
{

    public $useTable = 'partner';
    public $useIndex = "uuid";

    protected $_colums = array(
        'uuid',             // bin16
        'name',             // char 255
        'address',            // tiny text
        'active',     // tiny ,
        'created',           // datetime
        'lastmodify',       // datetime
    );
}