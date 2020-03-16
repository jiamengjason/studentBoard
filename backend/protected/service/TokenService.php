<?php

class TokenService
{

    /**
     * 判断token是否过期
     * @param $uid
     * @param $token
     * @return bool
     */
    public function tokenIsEffective($uid, $token){
        $bool = false;

        if (empty($uid) || empty($token)){
            return $bool;
        }

        $tokenModel = new Token();
        $tokenInfo = $tokenModel->find('user_id=:user_id and token=:token', ['user_id'=>$uid, 'token'=>$token]);
        if (empty($tokenInfo)){
            return $bool;
        }

        //判断token是否过期
        if ($tokenInfo['expire_time'] > time()){
            $bool = true;
        }

        return $bool;
    }
}