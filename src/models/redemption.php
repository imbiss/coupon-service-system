<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-10-11
 * Time: 上午12:01
 */

class redemption extends AppModel
{
    public $useTable = "redemption";

    public $useIndex = "id";

    public $_colums = array(
        'id', // int 10, AI
        'clientUuid', // Bin16,
        'partnerUuid', // bin16
        'usedCode', // vchar 255 Used Code
        'usedCodeHash', // bin16
        'ip', //
        'time', //dateTime redemption time
        'costType', // ENUM
        'costValue', // DECIMAL 13,4
        'costCurrency', // CHAR 3
        'consumerFirstName',
        'consumerLastName',
        'consumerEmail',
        'consumerOrderId', //
        'consumerOrderValue', // DECIMAL 13,4
        'consumerOrderCurrency', // CHAR 3
        'consumerAddress',
        'consumerZipcode',
        'consumerPhone',
        'consumerSession',
        'created', // timestamp
        'lastmodify' // timestamp
    );


}