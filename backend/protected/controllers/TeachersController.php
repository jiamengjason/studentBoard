<?php

/**
 * 知名教师
 * Class TeachersController
 */
class TeachersController extends FInterfaceBase
{
    /**
     * 【知名教师】列表页面
     */
    public function actionIndex(){
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['teacher_name'] = $this->_gets->getParam('teacher_name');
        $params['score_sort'] = $this->_gets->getParam('score_sort');   //0默认1预告2进行中3已结束
        if (!empty($params['score_sort']) && !in_array($params['score_sort'], ['desc', 'asc'])){
            $this->outputOk();
        }

        $teachersService = new TeachersService();
        $data = $teachersService->getTeachersListByParams($params);

        $this->outputOk('', $data);
    }

    /**
     * 【知名教师】教师详情
     */
    public function actionInfo(){
        $teacherId = $this->_gets->getParam('teacher_id');
        if (empty($teacherId)){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($teacherId);
        if (empty($userInfo)){
            $this->outputParamsError();
        }
        if ($userInfo['roleId'] != RoleGroupListConfig::$teacherRoleId){
            $this->outputParamsError();
        }

        //查询老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $avgScore = $evaluateScoreService->findAvgScoreByUid($teacherId);

        //查询对应机构名称
        $where = 'id = '.$userInfo['parentId'];
        $select = 'id,organization_name,organization_yewu';
        $organizationList = $usersService->getAllUsersByCondition($where, $select);
        $organizationList = array_column($organizationList, null, 'id');

        //返回数据
        $data = [
            'teacher_id' => $teacherId,
            'avg_score' => $avgScore,
            'teacher_name' => $userInfo['userName'],
            'head_img' => $userInfo['headImg'],
            'organization_id' => $userInfo['parentId'],
            'organization_name' => isset($organizationList[$userInfo['parentId']]) ? $organizationList[$userInfo['parentId']]['organization_name'] : '',
            'organization_yewu' => isset($organizationList[$userInfo['parentId']]) ? $organizationList[$userInfo['parentId']]['organization_yewu'] : '',
        ];

        $this->outputOk('', $data);
    }


    /**
     * 【知名教师】教师详情-相似老师
     */
    public function actionSimilar(){
        $teacherId = $this->_gets->getParam('teacher_id');
        $limit = $this->_gets->getParam('limit');
        $limit = $limit ? $limit : 0;
        if (empty($teacherId)){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($teacherId);
        if (empty($userInfo)){
            $this->outputParamsError();
        }
        if ($userInfo['roleId'] != RoleGroupListConfig::$teacherRoleId){
            $this->outputParamsError();
        }

        //查询老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $avgScore = $evaluateScoreService->findAvgScoreByUid($teacherId);

        //查询相似的老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $teacherList = $evaluateScoreService->findSimilarTeacherByUid($teacherId, $avgScore, $limit);

        $this->outputOk('', $teacherList);
    }

    /**
     * 【知名教师】教师详情-全部评论
     */
    public function actionCommentList(){
        $params['teacherId'] = $this->_gets->getParam('teacher_id');
        $params['page'] = $this->_gets->getParam('page');
        $params['page_size'] = $this->_gets->getParam('page_size');
        if (empty($params['teacherId'])){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($params['teacherId']);
        if (empty($userInfo)){
            $this->outputParamsError();
        }
        if ($userInfo['roleId'] != RoleGroupListConfig::$teacherRoleId){
            $this->outputParamsError();
        }

        //查询老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $data = $evaluateScoreService->findEvaluateScoreListById($params);

        $this->outputOk('', $data);
    }
}