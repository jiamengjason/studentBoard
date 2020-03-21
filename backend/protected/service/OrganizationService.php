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
}