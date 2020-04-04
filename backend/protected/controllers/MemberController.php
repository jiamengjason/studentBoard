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

    /**
     * 【个人中心】【机构】发布活动
     */
    public function actionPublish()
    {
        $active = [];
        if (empty($this->_gets->getParam('title_img'))){
            $this->outputParamsError('请上传活动图片');
        }
        if (empty($this->_gets->getParam('title'))){
            $this->outputParamsError('请填写活动标题');
        }
        if (empty($this->_gets->getParam('start_time'))){
            $this->outputParamsError('请填写活动开始时间');
        }
        if (empty($this->_gets->getParam('end_time'))){
            $this->outputParamsError('请填写活动结束时间');
        }
        if (empty($this->_gets->getParam('desc'))){
            $this->outputParamsError('请填写活动简介');
        }
        if (empty($this->_gets->getParam('addr'))){
            $this->outputParamsError('请填写活动地址');
        }
        $active['title_img'] = $this->_gets->getParam('title_img');
        $active['title'] = $this->_gets->getParam('title');
        $active['start_time'] = $this->_gets->getParam('start_time');
        $active['end_time'] = $this->_gets->getParam('end_time');
        $active['desc'] = $this->_gets->getParam('desc');
        $active['addr'] = $this->_gets->getParam('addr');

        //发布活动
        $organizationService = new OrganizationService();
        $bool = $organizationService->publishActive($this->userInfo, $active);

        if (true === $bool){
            $this->outputOk();
        }else {
            $this->outputError($bool);
        }
    }


    /**
     * 【个人中心】【机构】活动列表
     */
    public function actionActiveList()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['pageSize'] = $this->_gets->getParam('pageSize');
        $params['user_id'] = $this->userId;

        //查询用户信息
        $activeService = new ActiveService();
        $rs = $activeService->getActiveListByParams($params);

        $this->outputOk('', $rs);
    }

    /**
     * 【个人中心】【学生-家长】参加的活动列表
     */
    public function actionMyActive()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['pageSize'] = $this->_gets->getParam('pageSize');
        $params['user_id'] = $this->userId;

        //查询参加的活动列表
        $activeService = new ActiveService();
        $rs = $activeService->getMyActiveList($params);

        $this->outputOk('', $rs);
    }

    /**
     * 【机构-教师】评价页面接口
     */
    public function actionEvaluate(){
        $params = [];
        $params['score'] = $this->_gets->getParam('score');
        $params['is_recommend'] = $this->_gets->getParam('is_recommend');
        $params['tags'] = $this->_gets->getParam('tags');
        $params['comment'] = $this->_gets->getParam('comment');
        $params['evaluated_uid'] = $this->_gets->getParam('evaluated_uid');
        $params['user_id'] = $this->userId;
        if (empty($params['score'])){
            $this->outputParamsError('请选择教学质量');
        }
        if (empty($params['is_recommend'])){
            $this->outputParamsError('请选择是否会推荐给别的学生');
        }
        if (empty($params['tags'])){
            $this->outputParamsError('请选择教标签');
        }
        if (empty($params['comment'])){
            $this->outputParamsError('请输入评论详细');
        }
        if (empty($params['evaluated_uid'])){
            $this->outputParamsError('请选择要评价的教师/机构');
        }
        if (!in_array($params['score'], RoleGroupListConfig::getScoreList())){
            $this->outputParamsError('选择的评分有误呦~');
        }
        //只能学生和家长进行评价
        if (!in_array($this->userInfo['role_id'], [RoleGroupListConfig::$parentRoleId, RoleGroupListConfig::$studentRoleId])){
            $this->outputParamsError('只能学生/家长才能评价呦~');
        }

        //查询要评价的用户信息
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($params['evaluated_uid']);
        if (empty($userInfo)){
            $this->outputParamsError('请选择要评价的教师/机构');
        }
        if (!in_array($userInfo['roleId'], [RoleGroupListConfig::$organizationRoleId, RoleGroupListConfig::$teacherRoleId])){
            $this->outputParamsError('只能对教师/机构评价呦~');
        }
        $params['evaluated_role_id'] = $userInfo['roleId'];

        //提交评价
        $commonService = new EvaluateScoreService();
        $bool = $commonService->comment($params);
        if ($bool){
            $this->outputOk('提交成功', $bool);
        }else {
            $this->outputError('提交失败', $bool);
        }
    }
}