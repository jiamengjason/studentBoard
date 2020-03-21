<?php

class MemberController extends FSessionInterfaceBase
{
    /**
     * 用户信息
     */
    public function actionInfo()
    {
        //查询用户信息
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($this->userId);

        $this->outputOk('', $userInfo);
    }

    /**
     * 更新用户信息
     */
    public function actionUpdate()
    {
        if (false == $this->isLogin){
            $this->outputSessionInvalid();
        }
        //编辑用户信息
        $usersService = new UsersService();
        $usersService->updateUserInfo($this->userId, $this->_gets);

        $this->outputOk();
    }
}