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

        $usersModel = new Users();
        $criteria = new CDbCriteria();
        $criteria->order = 't.end_time DESC';
        if (!empty($params)){
            $condition = '1 ';
            foreach ($params as $field=>$v){
                if (empty($v)){
                    continue;
                }
                if ($field == 'user_id'){//查询机构下的活动列表
                    $condition .= ' and user_id = ' . $v . ' and status_is = 1';
                }elseif($field == 'title'){//根据活动名称模糊搜索
                    $condition .= ' and title like \'%' . trim($v) . '%\'';
                }elseif($field == 'type' && $v == 1){//活动预告
                    $condition .= ' and start_time >\'' . date('Y-m-d H:i:s').'\'';
                }elseif($field == 'type' && $v == 2){//活动进行中
                    $condition .= ' and start_time <\'' . date('Y-m-d H:i:s').'\' and end_time >\'' . date('Y-m-d H:i:s').'\'';
                }elseif($field == 'type' && $v == 3){//已结束
                    $condition .= ' and end_time <\'' . date('Y-m-d H:i:s').'\'';
                }
            }
            $criteria->condition = $condition;
        }
        $count = $usersModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $pageSize;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $usersModel->findAll($criteria);

        $data = [];
        $time = time();
        foreach ($list as $item){
            $data[] = [
            ];
        }

        return ['list'=>$data, 'page_count'=>$pages->getPageCount(), 'page'=>$pages->getCurrentPage() + 1, 'page_size'=>$pages->getPageSize()];
    }
}