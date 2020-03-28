<?php
/**
 * 机构
 * Class OrganizationsController
 */
class OrganizationsController extends FInterfaceBase
{
    /**
     * 【著名机构】机构详情
     */
    public function actionInfo(){
        $organizationId = $this->_gets->getParam('organization_id');
        if (empty($organizationId)){
            $this->outputParamsError();
        }
        $usersService = new UsersService();
        $userInfo = $usersService->getUserInfoByUid($organizationId);
        if (empty($userInfo)){
            $this->outputParamsError();
        }
        if ($userInfo['roleId'] != RoleGroupListConfig::$organizationRoleId){
            $this->outputParamsError();
        }

        //查询机构评价得分
        $evaluateScoreService = new EvaluateScoreService();
        $avgScore = $evaluateScoreService->findAvgScoreByUid($organizationId);

        //返回数据
        $data = [
            'organization_id' => $organizationId,
            'avg_score' => $avgScore,
            'head_img' => $userInfo['headImg'],
            'organization_name' => $userInfo['organizationName'],
            'organization_email' => $userInfo['organizationEmail'],
            'organization_desc' => $userInfo['organizationDesc'],
            'organization_yewu' => $userInfo['organizationYewu'],
            'organization_phone' => $userInfo['organizationPhone'],
            'organization_www' => $userInfo['organizationWww'],
        ];

        $this->outputOk('', $data);
    }

}