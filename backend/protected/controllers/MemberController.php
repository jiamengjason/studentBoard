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
        //编辑用户信息
        $usersService = new UsersService();
        $bool = $usersService->updateUserInfo($this->userId, $this->_gets);

        if (false == $bool){
            $this->outputParamsError();
        }
        $this->outputOk();
    }

    /**
     * 【个人中心】修改用户绑定信息
     */
    public function actionUpdateUnion(){
        //开始校验
        $data = [];
        $data['type'] = $this->_gets->getParam('type');
        switch ($data['type']){
            case 1:
                $data['oldPassword'] = $this->_gets->getParam('oldPassword');
                $data['newPassword'] = $this->_gets->getParam('newPassword');
                $data['rePassword'] = $this->_gets->getParam('rePassword');
                if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['rePassword'] )){
                    $this->outputParamsError();
                }
                if ($data['oldPassword'] == $data['newPassword']){
                    $this->outputParamsError('新密码不能与原密码重复');
                }
                if ($data['newPassword'] !== $data['rePassword'] ){
                    $this->outputParamsError('新密码不一致');
                }
                break;
            case 2:
                $data['newEmail'] = $this->_gets->getParam('newEmail');
                $data['validCode'] = $this->_gets->getParam('validCode');
                if (empty($data['newEmail']) || empty($data['validCode'])){
                    $this->outputParamsError();
                }
                break;
            case 3:
                $data['newMobile'] = $this->_gets->getParam('newMobile');
                $data['validCode'] = $this->_gets->getParam('validCode');
                if (empty($data['newMobile']) || empty($data['validCode'])){
                    $this->outputParamsError();
                }
                break;
            default:
                $this->outputParamsError();
        }

        //编辑用户信息
        $usersService = new UsersService();
        $bool = $usersService->updateUserUnionInfo($this->userInfo, $data);

        if (true === $bool){
            $this->outputOk();
        }else {
            $this->outputError($bool);
        }
    }
}