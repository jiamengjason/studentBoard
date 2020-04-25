<?php

class MemberController extends FSessionInterfaceBase
{
    /**
     * 用户信息
     */
    public function actionInfo()
    {
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

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
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }
        //老师课程
        if (isset($this->_requestParams['teacherCourse']) && !empty($this->_requestParams['teacherCourse'])){
            $this->_requestParams['teacherCourse'] = implode(',', $this->_requestParams['teacherCourse']);
        }
        //机构业务
        if (isset($this->_requestParams['organizationYewu']) && !empty($this->_requestParams['organizationYewu'])){
            $this->_requestParams['organizationYewu'] = implode(',', $this->_requestParams['organizationYewu']);
        }

        //编辑用户信息
        $usersService = new UsersService();
        $bool = $usersService->updateUserInfo($this->userId, $this->_requestParams);

        if (false == $bool){
            $this->outputParamsError();
        }
        $this->outputOk();
    }

    /**
     * 【个人中心】修改用户绑定信息
     */
    public function actionUpdateUnion(){
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

        //开始校验
        $data = [];
        $data['type'] = isset($this->_requestParams['type']) ? $this->_requestParams['type'] : '';
        switch ($data['type']){
            case 1:
                $data['oldPassword'] = isset($this->_requestParams['oldPassword']) ? $this->_requestParams['oldPassword'] : '';
                $data['newPassword'] = isset($this->_requestParams['newPassword']) ? $this->_requestParams['newPassword'] : '';
                $data['rePassword'] = isset($this->_requestParams['rePassword']) ? $this->_requestParams['rePassword'] : '';
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
                $data['newEmail'] = isset($this->_requestParams['newEmail']) ? $this->_requestParams['newEmail'] : '';
                $data['validCode'] = isset($this->_requestParams['validCode']) ? $this->_requestParams['validCode'] : '';
                if (empty($data['newEmail']) || empty($data['validCode'])){
                    $this->outputParamsError();
                }
                break;
            case 3:
                $data['newMobile'] = isset($this->_requestParams['newMobile']) ? $this->_requestParams['newMobile'] : '';
                $data['validCode'] = isset($this->_requestParams['validCode']) ? $this->_requestParams['validCode'] : '';
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
    public function actionPublish(){
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

        $active = [];
        $active['title_img'] = isset($this->_requestParams['title_img']) ? $this->_requestParams['title_img'] : '';
        $active['title'] = isset($this->_requestParams['title']) ? $this->_requestParams['title'] : '';
        $active['start_time'] = isset($this->_requestParams['start_time']) ? $this->_requestParams['start_time'] : '';
        $active['end_time'] = isset($this->_requestParams['end_time']) ? $this->_requestParams['end_time'] : '';
        $active['desc'] = isset($this->_requestParams['desc']) ? $this->_requestParams['desc'] : '';
        $active['addr'] = isset($this->_requestParams['addr']) ? $this->_requestParams['addr'] : '';

        if (empty($active['title_img'])){
            $this->outputParamsError('请上传活动图片');
        }
        if (empty($active['title'])){
            $this->outputParamsError('请填写活动标题');
        }
        if (empty($active['start_time'])){
            $this->outputParamsError('请填写活动开始时间');
        }
        if (empty($active['end_time'])){
            $this->outputParamsError('请填写活动结束时间');
        }
        if (empty($active['desc'])){
            $this->outputParamsError('请填写活动简介');
        }
        if (empty($active['addr'])){
            $this->outputParamsError('请填写活动地址');
        }

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
        $params['page_size'] = $this->_gets->getParam('page_size');
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
        $params['page_size'] = $this->_gets->getParam('page_size');
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
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

        $params = [];
        $params['score'] = isset($this->_requestParams['score']) ? $this->_requestParams['score'] : '';
        $params['is_recommend'] = isset($this->_requestParams['is_recommend']) ? $this->_requestParams['is_recommend'] : '';
        $params['tags'] = isset($this->_requestParams['tags']) ? $this->_requestParams['tags'] : '';
        $params['comment'] = isset($this->_requestParams['comment']) ? $this->_requestParams['comment'] : '';
        $params['evaluated_uid'] = isset($this->_requestParams['evaluated_uid']) ? $this->_requestParams['evaluated_uid'] : '';
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

    /**
     * 【课外活动】活动详情页面-报名活动
     */
    public function actionAttendActive(){
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

        $activeId = isset($this->_requestParams['active_id']) ? $this->_requestParams['active_id'] : '';
        $num = isset($this->_requestParams['num']) ? $this->_requestParams['num'] : '';
        $tType = isset($this->_requestParams['t_type']) ? $this->_requestParams['t_type'] : '';
        $userId = $this->userId;
        if (empty($activeId)){
            $this->outputParamsError('该活动不存在呦~');
        }
        if (empty($num)){
            $this->outputParamsError('请输入报名人数');
        }
        if (empty($tType) || !in_array($tType, [1, 2])){
            $this->outputParamsError('请选择活动题型方式');
        }
        $params = [
            'active_id' => $activeId,
            'user_id' => $userId,
            'num' => $num,
            't_type' => $tType
        ];

        //查询报名的活动是否存在
        $activeService = new ActiveService();
        if (empty($activeService->getActiveInfoById($activeId))){
            $this->outputParamsError('该活动不存在呦~');
        }
        //查询用户是否已经报名活动
        if (!empty($activeService->isUserAttendActive($userId, $activeId))){
            $this->outputParamsError('已经报名该活动了呦~');
        }

        //报名活动
        $data = $activeService->attendActive($params);
        if ($data){
            $this->outputOk('报名成功');
        }else {
            $this->outputError('报名失败');
        }
    }

    /**
     * 【个人中心】【学生-家长】我的评论
     */
    public function actionMyComment()
    {
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['user_id'] = $this->userId;

        //查询参加的活动列表
        $activeService = new EvaluateScoreService();
        $rs = $activeService->getCommentListByParams($params);

        $this->outputOk('', $rs);
    }

    /**
     * 【留学圈】提个问题
     */
    public function actionQa(){
        if (false == $this->isPostRequest()){
            $this->outputParamsError();
        }

        $question = isset($this->_requestParams['question']) ? $this->_requestParams['question'] : '';
        $userId = $this->userId;
        if (empty($question)){
            $this->outputParamsError('请提问问题呦~');
        }
        $params = [
            'user_id' => $userId,
            'question' => $question,
            'status_is' => 1
        ];

        //查询报名的活动是否存在
        $qaService = new QaService();
        $bool = $qaService->addQa($params);
        if ($bool){
            $this->outputOk('提问成功');
        }else {
            $this->outputError('提问失败，请重试~');
        }
    }

    /**
     * 【个人中心】退出登录
     */
    public function actionLogout()
    {
        //查询参加的活动列表
        $tokenService = new TokenService();
        $rs = $tokenService->logout($this->userId);

        $this->outputOk('', $rs);
    }
}