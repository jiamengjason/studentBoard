<?php

/**
 * 知名教师
 * Class TeachersController
 */
class TeachersController extends FInterfaceBase
{

    /**
     * 【知名教师】教师详情
     */
    public function actionInfo(){
        $userId = $this->_gets->getParam('user_id');
        if (empty($userId)){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($userId);
        if (empty($userInfo)){
            $this->outputParamsError();
        }
        if ($userInfo['roleId'] != RoleGroupListConfig::$teacherRoleId){
            $this->outputParamsError();
        }

        //查询老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $avgScore = $evaluateScoreService->findAvgScoreByUid($userId);

        //查询对应机构名称
        $where = 'id = '.$userInfo['parentId'];
        $select = 'id,organization_name,organization_yewu';
        $organizationList = $usersService->getAllUsersByCondition($where, $select);
        $organizationList = array_column($organizationList, null, 'id');



        //返回数据
        $data = [
            'user_id' => $userId,
            'avgScore' => $avgScore,
            'user_name' => $userInfo['userName'],
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
        $userId = $this->_gets->getParam('user_id');
        $limit = $this->_gets->getParam('limit');
        $limit = $limit ? $limit : 0;
        if (empty($userId)){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($userId);
        if (empty($userInfo)){
            $this->outputParamsError();
        }

        //查询老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $avgScore = $evaluateScoreService->findAvgScoreByUid($userId);

        //查询相似的老师评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $teacherList = $evaluateScoreService->findSimilarTeacherByUid($userId, $avgScore, $limit);

        //返回数据
        $data = [
            'user_id' => $userId,
            'user_name' => $userInfo['userName'],
            'list' => $teacherList
        ];

        $this->outputOk('', $data);
    }
}