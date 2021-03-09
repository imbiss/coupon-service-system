<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-7-26
 * Time: 下午9:38
 */
class couponCode  extends AppModel
{

    public $useTable = 'couponCode';
    public $useIndex = "id";

    const DELIVERED = 1;
    const NOT_DELIVERED = 0;


    protected $_colums = array(
        "id", //	int(10)		UNSIGNED	否 	无	AUTO_INCREMENT
        'partnerUuid', // bin16
        'clientUuid', // bin16
        "couponUuid", // FK Bin32 UUID
        "code", // char255
        "codeHash", // bin16
        "isDeliverd", // 0 尚未送出
        "timeUsed", // 0 未使用,
        "allowTimeUsed",
        'validFrom', // datetime
        'validUntil', // datetime
        'created',
        'lastmodify'
    );


    public function delByCouponUuid($uuid)
    {

    }

    /**
     * 增加号码的使用次数
     * @param $id 号码id
     * @param int $count 增加次数 默认1
     * @return mixed
     */
    public function increaseTimeUsed($id, $count=1)
    {
        $sql = sprintf('UPDATE %s SET timeUsed = timeUsed + %d WHERE id=%d LIMIT 1',
            $this->getTbName(),
            intval($count),
            intval($id));
        return $this->query($sql);
    }


}
/* EOF */