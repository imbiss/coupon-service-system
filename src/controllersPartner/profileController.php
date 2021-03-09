<?php
use Outlet\UI\Alert;
use Coupon\BL\User\Login;
use Coupon\Controller\Partner;
use Coupon\Model\User as User;
use Coupon\Filter\ColumnValue;
use Coupon\Translator\Columns;

/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-4-10
 * Time: 下午9:32
 */

class profileController extends Partner
{


    protected $_translate = array(
        'uuid' => '账户标示',
        'email' => '电子邮件',
        'active' => '是否激活',
        'created' => '创建时间',
        'lastmodify' => '最后修改',
        'PartnerUuid' => '合作伙伴标示',
        'PartnerName' => '合作伙伴名称',
        'PartnerAddress' => '合作伙伴地址',
        'PartnerActive' => '合作伙伴是否激活',
        'PartnerCreated' => '合作伙伴创建时间',
        'PartnerLastmodify' => '合作伙伴最后修改时间',
        'api_key' => 'API KEY',
        'api_secret_key' => 'API 秘钥'
    );


    /**
     *  显示用户账号
     *
     */
    public function index()
    {
        try {
            $this->setPageTitle("帐号信息");
            // 定义隐藏列
            $hiddenColumns = array('emailhash','passwordhash', 'partnerUuid');

            // 定义filter
            $uuidFilters = new Coupon\UI\Filter\Uuid(array('PartnerUuid', 'uuid'));
            $this->set('valueFilter', $uuidFilters->getFilter());

            $user = $this->_getUserFromSession();

            foreach($hiddenColumns as $col) {
                unset($user[$col]);
            }

            // 定义key翻译
            $translate = new Columns();
            $translate->setMapping($this->_translate);

            $this->set('userData', $user)
                ->set('keyTranslator', $translate);
        } catch (\Exception $e) {
            // Validate Exception or Login Failed
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage());
        }
        return; // display login page with error message.
    }

    /**
     * Chnage User password
     *
     */
    public function changePassword()
    {
        if (!isset($_POST['submit-changePassword'])) {
            return $this->redirect('/partner/profile');
        }
        try {
            $passwordCurrent = trim($this->_getRequired('password-current'));
            $password = trim($this->_getRequired('password'));
            $passwordRepeat = trim($this->_getRequired('password-repeat'));


            $user = $this->_getUserFromSession();
            if ($user['passwordhash'] !== hex2bin(User::hashPassword($passwordCurrent))) {
                throw new \Exception("当前密码错误");
                return;
            }

            if (($password) == ($passwordRepeat)) {
                if (empty($password)) {
                    throw new \Exception('密码不能为空');
                }
                $model = new User;
                $r = $model->changePassword(bin2hex($user['uuid']), $password);
                if ($r == 1) {
                    $this->_addMessagebox(Alert::TYPE_SUCC, '密码更改成功。您需要登出后才能使新密码生效。', null, null);
                } else {
                    throw new \Exception('修改密码失败');
                }

            } else {
                throw new \Exception('密码不符合，请重新输入。');
            }
        } catch (\Exception $e) {
            $this->_addMessagebox(Alert::TYPE_DANG, $e->getMessage());
        }
        $this->index();
        return $this->render('index');
    }

}
/* EOF */