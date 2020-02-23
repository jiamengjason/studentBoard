<?php

class OrganizationService
{
    /**
     * 查询所有机构
     * @return array|CActiveRecord[]
     */
    public function getAllOrganizationUsers(){
        $conditions = [
            'role_id' => RoleGroupListEnums::$organizationRoleId,
            'status_is' => 1
        ];
        $usersService = new UsersService();
        return $usersService->getAllUsersByCondition($conditions);
    }
}