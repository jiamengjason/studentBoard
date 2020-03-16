<?php

class FSessionInterfaceBase extends FInterfaceBase
{
    /**
	 * 初始化
	 * @see CController::init()
	 */
    public function init ()
    {
        parent::init();

        //教研用户token是否正确
        $token = $this->_gets->getParam('token');
        $userId = $this->_gets->getParam('user_id');
        if (empty($userId) || empty($token)){
            $this->outputError('请重新登陆');
        }
        //验证token是否失效
        $tokenService = new TokenService();
        if (false == $tokenService->tokenIsEffective($userId, $token)){
            $this->outputError('登陆信息已失效，请重新登陆');
        }

    }
}