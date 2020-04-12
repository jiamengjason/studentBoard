<?php

class FSessionInterfaceBase extends FInterfaceBase
{
    protected $userId;
    protected $token;
    protected $isLogin = false;
    protected $userInfo;

    /**
	 * 初始化
	 * @see CController::init()
	 */
    public function init ()
    {
        parent::init();

        //教研用户token是否正确
        $token = isset($this->_requestParams['token']) ? $this->_requestParams['token'] : $this->_gets->getParam('token');
        $userId = isset($this->_requestParams['userId']) ? $this->_requestParams['userId'] : $this->_gets->getParam('userId');
        if (empty($userId) || empty($token)){
            $this->outputError('请重新登陆');
        }
        //验证token是否失效
        $tokenService = new TokenService();
        if (false == $tokenService->tokenIsEffective($userId, $token)){
            $this->outputSessionInvalid();
        }

        //当前登录用户信息
        $this->isLogin = true;
        $this->userId = $userId;
        $this->token = $token;
        $this->userInfo = Users::model()->findByPk($this->userId);
        //判断用户是否禁用
        if ($this->userInfo['status_is'] == 0){
            $this->outputSessionInvalid();
        }
    }

    /**
     * 登陆信息已失效，请重新登陆
     */
    public function outputSessionInvalid(){
        $this->outputError('登陆信息已失效，请重新登陆');
    }
}