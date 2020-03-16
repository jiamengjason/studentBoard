<?php

class MemberController extends FSessionInterfaceBase
{
    /**
     * 用户信息
     */
    public function actionInfo()
    {
        $userId = $this->_gets->getParam('user_id');
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($userId);

        $this->outputOk('', $userInfo);
    }

}