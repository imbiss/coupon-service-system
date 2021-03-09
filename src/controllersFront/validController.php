<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-10-2
 * Time: 下午10:12
 */

use Coupon\Controller\Frontend;
use Coupon\BL\CouponValidator;

class validController extends Frontend
{


    /**
     * 检验优惠码.
     * 只用GET参数
     *
     */
    public function index()
    {
        try {
            $this->setLayout('mobile');
            $this->setPageTitle('检验优惠码');
            if (isset($_REQUEST['submit'])) {
                //$clientUuid = trim($this->_getRequired('clientUuid'));
                //$couponCode = trim($this->_getRequired('couponCode'));
                $clientUuid = "36EBC8E5DEBC47C7A2276C62FF8AD156";
                $couponCode = "ZFkdz-34";
                $validator = new CouponValidator($clientUuid, $couponCode);
                $isValid = $validator->isValid(CouponValidator::VALID_TYPE_CHECK);
                $this->set('validator', $validator)
                    ->set('couponCode', $couponCode)
                    ->set('isValid', $isValid);

                return;
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
        }

    }
}