<?php

// +----------------------------------------------------------------------
// | WoShiMaiJia Projcet 
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2011 http://woshimaijia.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: xinqiyang <xinqiyang@gmail.com>
// +----------------------------------------------------------------------

class MisService {

    public static function actCheckLogin($param) {
        $id = 0;
        $code = Error::PARAM_ERROR;
        if (!empty($param['account']) && !empty($param['password'])) {
            extract($param);
            $user = BaseLogic::get('services', "", "*", "account='{$account}' and password='{$password}' and status=0");
            //var_dump($user,$param);die;
            if (!empty($user)) {
                Session::set('uid', $user['id']);
                Session::set('uinfo', json_encode($user));
                $code = Error::SUCCESS;
                $id = $user['id'];
                jump(U('index/index'));
            } else {
                $code = Error::LOGIN_UN_PWD_ERR;
            }
            return array('code' => $code, 'data' => $id);
        }
    }

}