<?php

class TokenService
{
    //token有效期
    public $tokenLifeTime = 7200;

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
            $expireTime = time() + $this->tokenLifeTime;
            $this->updateTokenInfo($tokenInfo['id'], ['expire_time'=>$expireTime]);
        }

        return $bool;
    }

    /**
     * 更新用户登录token信息
     * @param $pk
     * @param $params
     * @return int
     */
    public function updateTokenInfo($pk, $params){
        $tokenModel = new Token();
        return $tokenModel->updateByPk($pk, $params);
    }

    /**
     * 退出登录清楚token
     * @param $userId
     * @return int
     */
    public function logout($userId){
        return Token::model()->deleteAll('user_id=:user_id', ['user_id'=>$userId]);
    }
}