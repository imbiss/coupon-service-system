<?php
use \Outlet\UI\Alert;
use \Coupon\Controller\Partner;
use \Coupon\Model\CouponCode;
use \Coupon\Model\Coupon;
use \Coupon\Model\Client;
use \Coupon\Api\Client as ApiClient;

class apitoolsController extends Partner
{

    public $uses = array('coupon','couponCode');

    public $helpers = array('url', 'form');

    /**
     *
     */
    public function __construct()
    {

        parent::__construct();
        $this->addHeaderCSS('/partner/css/plugins/dataTables.bootstrap.css');

    }


    /**
     * view coupon code
     *
     */
    public function index()
    {


    }

    /**
     * Get a coupon code by given coupon Uuid via API
     */
    public function getCode()
    {
         try{
            $partner = $this->_getUserFromSession();
            $partnerUuid = $partner['uuid'];
            $m = new Coupon();
            $this->set('coupons', $m->findAllInPair(bin2hex($partnerUuid)));

            if (isset($_POST['submit'])) {
                $couponUuid = $this->_getRequired('couponUuid');
                /**
                $options = array(
                    'partnerUuid' => $partnerUuid, // we you are
                );
                $checksum = '';
                $client = new ApiClient($options);
                $client->getUnplacedCode($couponUuid, 100, $checksum);
                */

                $m = new CouponCode();
                $r = $m->getUnplacedCode($couponUuid, 100); // get the first 100 record
                if (count($r) < 1) {
                    throw new \Exception("Can not get coupon code.");
                }
                $key = array_rand($r,1);
                $r = $r[$key];
                if ($r) {
                    $this->set('data', $r)
                        ->set('valueFilter', self::_getFilter());
                }
            }

         } catch (\Exception $e) {
             $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage(), null, null);
         }
    }

    public function validate()
    {
        $partner = $this->_getUserFromSession();
        $partnerUuid = $partner['uuid'];
        $m = new Client();
        $this->set('clients', $m->fetchByPartnerUuid($partnerUuid));

        if (isset($_POST['submit'])) {
            $clientUuid = $this->_getRequired('clientUuid');
            $couponCode = $this->_getRequired('couponCode');
            $m = new CouponCode();
            $this->set('result', $m->findByClient($couponCode, $clientUuid))
                ->set('valueFilter', $this->_getFilter());
            return;
        }

    }

    /**
     * 发送优惠券代码
     *
     */
    public function distribute()
    {
        $partner = $this->_getUserFromSession();
        $partnerUuid = $partner['uuid'];
        $m = new Coupon();
        $this->set('coupons', $m->findAllInPair(bin2hex($partnerUuid)));
    }


    public function redemption()
    {

    }

}
/* EOF */