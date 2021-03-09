<?php
/**
 * deliveryHistory.php
 * The record for coupon delivery history
 *
 *
 * @category
 * @package
 * @subpackage
 * @author Hongyi Chen <hongyi.chen@sovendus.com>
 * @copyright Copyright (c) 2010-2014 Sovendus GmbH (http://www.sovendus.com)
 */
class redemption extends AppModel
{
    public $useTable = "deliveryHistory";

    public $useIndex = "id";


    public $_colums = array(
        'id', //
        'clientUuid', // Bin16,
        'partnerUuid', // bin 16
        'deliverCouponCodeId', // coupon code id
        'deliverCouponCode', // vchar 255 Used Code
        'deliverCouponCodeHash', // bin16
        'operatorIp', // The IP of operator
        'costType', // ENUM
        'costValue', // DECIMAL 13,4
        'costCurrency', // CHAR 3
        'consumerFirstName',
        'consumerLastName',
        'consumerEmail',
        'deliveryReason',
        'created', // timestamp (auto)
        'lastmodify' // timestamp (auto)
    );
}