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

}