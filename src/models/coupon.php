<?php

class coupon extends AppModel
{

    public $useTable = 'coupon';
    public $useIndex = "uuid";

    const COST_PER_LEAD = 'COST_PER_LEAD';
    const COST_PER_ORDER = 'COST_PER_ORDER';
    const COST_PER_PROVISION = 'PROVISION';

    protected $_colums = array(
        "id", //	int(10)		UNSIGNED	否 	无	AUTO_INCREMENT
        "uuid", // bin(16) unique
        'partnerUuid', // bin16 FK,
        'clientUuid', // bin16 FK
        "name", //
        "shortDescription", // char255
        "description", //  long text
        "couponType", // tiny Int 类型 0 固定面值 1 百分比
        'couponValue', // 价值数值 5，00 或者 0.10 （10%）
        'couponCurrency',
        'validDateInterval', // 有效期 char
        'couponUseCondition', // string JSON Array 一组
        'minimumValue', //DEC 13,4 订单最小金额
        'activeFrom',
        'activeUntil', // datetime
        'active',
        'costType', // ENUM 'COST_PER_LEAD', 'COST_PER_ORDER', 'PROVISION'
        'costValue', // DEC 13,4
        'costCurrency', // CHAR 3
        'customCallbackParameter', // TEXT JSON数组
        'created', // auto
        'lastmodify' // auto
    );
}
/* EOF */