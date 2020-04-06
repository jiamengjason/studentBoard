<?php
/**
 * 机构
 * Class OrganizationsController
 */
class OrganizationsController extends FInterfaceBase
{
    /**
     * 【著名机构】列表页面
     */
    public function actionIndex(){
        $params = [];
        $params['page'] = $this->_gets->getParam('page');
        $params['page_size'] = $this->_gets->getParam('page_size');
        $params['organization_name'] = $this->_gets->getParam('organization_name');
        $params['score_sort'] = $this->_gets->getParam('score_sort');   //0默认1预告2进行中3已结束
        if (!empty($params['score_sort']) && !in_array($params['score_sort'], ['desc', 'asc'])){
            $this->outputOk();
        }

        $organizationService = new OrganizationService();
        $data = $organizationService->getOrganizationListByParams($params);

        $this->outputOk('', $data);
    }

    /**
     * 【著名机构】机构详情
     */
    public function actionDetail(){
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

    /**
     * 【著名机构】机构详情-名师团队
     */
    public function actionFamousTeacher(){
        $organizationId = $this->_gets->getParam('organization_id');
        $limit = $this->_gets->getParam('limit');
        $limit = $limit ? $limit : 0;
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

        //根据机构id查询名师团队
        $evaluateScoreService = new EvaluateScoreService();
        $organizationList = $evaluateScoreService->findTeacherListOfOrganizationByOid($organizationId, $limit);

        $this->outputOk('', $organizationList);
    }
}