<?php

class TeachersService
{
    /**
     * 查询老师列表
     * @param $params
     * @return array
     */
    public function getTeachersListByParams($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;

        $where = 'u.role_id = '.RoleGroupListConfig::$teacherRoleId;
        $orderBy = 'order by e.score desc,e.e_num desc';
        $limitSql = 'limit '.$limit.','.$pageSize;
        if (isset($params['teacher_name']) && !empty($params['teacher_name'])){
            $where .= ' and user_name like \'%' . $params['teacher_name'] . '%\'';
        }
        if (isset($params['score_sort']) && $params['score_sort'] == 'desc'){
            $orderBy = 'order by e.score desc';
        }
        if (isset($params['score_sort']) && $params['score_sort'] == 'asc'){
            $orderBy = 'order by e.score asc';
        }

        $sqlCount = 'select count(id) c from sb_users u where '.$where;
        $sql = 'select 
	u.id user_id,u.parent_id,u.user_name,u.head_img,e.score,e.e_num 
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
        $parentIds = array_unique(array_column($userList, 'parent_id'));
        $parentList = [];
        if (!empty($parentIds)){
            $parentList = $dbHandel->createCommand('select id,organization_name from sb_users where id in('.implode(',', $parentIds).')')->queryAll();
            $parentList = array_column($parentList, null, 'id');
        }
        //遍历
        foreach ($userList as $key=>$item){
            if (isset($parentList[$item['parent_id']])){
                $userList[$key]['organization_name'] = $parentList[$item['parent_id']]['organization_name'];
            }
            if (empty($item['score'])){
                $userList[$key]['score'] = '0.0';
            }
            if (empty($item['e_num'])){
                $userList[$key]['e_num'] = '0';
            }
        }

        $data['page_count'] = $totalNum;
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $userList;
        return $data;
    }

    /**
     * 查询老师列表
     * @param $organizationId
     * @param $limit
     * @return mixed
     */
    public function getTeachersListByOrganizationId($organizationId, $limit = 3){
        $where = 'u.parent_id = '.$organizationId.' and u.role_id = '.RoleGroupListConfig::$teacherRoleId;
        $orderBy = 'order by e.score desc,e.e_num desc';
        $sql = 'select 
	u.id user_id,u.user_name,u.head_img,IFNULL(e.score,0.0) as score
from sb_users u
left join (
	select ANY_VALUE(evaluated_uid) evaluated_uid, round(avg(score),1) as score, count(id) e_num  
	from sb_evaluate_score  
	group by evaluated_uid
) as e on u.id = e.evaluated_uid
where '.$where.' '.$orderBy.' limit '.$limit;

        $dbHandel = Yii::app()->db;
        $userList = $dbHandel->createCommand($sql)->queryAll();
        return $userList;
    }
}