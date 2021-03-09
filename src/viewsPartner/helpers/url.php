<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-11
 * Time: 下午11:17
 */
    class UrlHelper extends Helper
    {
        /**
         * 返回一个符合路由规则的url
         *
         */
        public function g($controller='main', $action='index', $params = array())
        {
            $basic = array(
                'controller' => $controller,
                'action' => $action
            );
            $params = array_merge($basic, $params);
            return "index.php?" . http_build_query($params);
        }
    }

?>