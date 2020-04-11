<?php

class OrganizationService
{
    /**
     * 查询所有机构
     * @return array|CActiveRecord[]
     */
    public function getAllOrganizationUsers(){
        $conditions = [
            'role_id' => RoleGroupListConfig::$organizationRoleId,
            'status_is' => 1
        ];
        $usersService = new UsersService();
        return $usersService->getAllUsersByCondition($conditions);
    }

    /**
     * 【个人中心】【机构】发布活动
     * @param $userInfo
     * @param $active
     * @return bool|string
     */
    public function publishActive($userInfo, $active){
        //判断是否机构角色
        if ($userInfo['role_id'] != RoleGroupListConfig::$organizationRoleId){
            return '只能机构角色才可以发布活动呦~';
        }

        //发布活动
        $active['user_id'] = $userInfo['id'];
        $active['status_is'] = 1;

        $activeModel = new Active();
        $activeModel->setAttributes($active);
        return $activeModel->save();
    }

    /**
     * 查询机构列表
     * @param $params
     * @return array
     */
    public function getOrganizationListByParams($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;

        $where = 'u.role_id = '.RoleGroupListConfig::$organizationRoleId;
        $orderBy = 'order by e.score desc,e.e_num desc';
        $limitSql = 'limit '.$limit.','.$pageSize;
        if (isset($params['organization_name']) && !empty($params['organization_name'])){
            $where .= ' and organization_name like \'%' . $params['organization_name'] . '%\'';
        }
        if (isset($params['score_sort']) && $params['score_sort'] == 'desc'){
            $orderBy = 'order by e.score desc';
        }
        if (isset($params['score_sort']) && $params['score_sort'] == 'asc'){
            $orderBy = 'order by e.score asc';
        }

        $sqlCount = 'select count(id) c from sb_users u where '.$where;
        $sql = 'select 
	u.id user_id,u.user_name,u.head_img,u.organization_name,u.organization_yewu,u.organization_phone,u.organization_name,u.organization_desc,e.score,e.e_num 
from sb_users u
left join (
	select ANY_VALUE(evaluated_uid) evaluated_uid, round(avg(score),1) as score, count(id) e_num  
	from sb_evaluate_score  
	group by evaluated_uid
) as e on u.id = e.evaluated_uid
where '.$where.' '.$orderBy.' '.$limitSql;

        $dbHandel = Yii::app()->db;
        $userList = $dbHandel->createCommand($sql)->queryAll();
        $countRs = $dbHandel->createCommand($sqlCount)->queryAll();
        $totalNum = 0;
        if (isset($countRs[0]['c'])){
            $totalNum = ceil($countRs[0]['c'] / $pageSize);
            $data['total_num'] = $countRs[0]['c'];
        }
        //获取机构下的推荐老师
        $teacherService = new TeachersService();
        foreach ($userList as $key=>$item){
            $userList[$key]['teacher_list'] = $teacherService->getTeachersListByOrganizationId($item['user_id']);
        }

        $data['page_count'] = $totalNum;
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $userList;
        return $data;
    }
}