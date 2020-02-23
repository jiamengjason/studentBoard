<?php

class OrganizationService
{

    /**
     * 获取机构列表
     * @return array
     */
    public function adminGetOrganizationPageList(){
        $usersModel = new Users();
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $criteria->condition = 'role_id = ' . RoleGroupListEnums::$organizationRoleId;
        $count = $usersModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = CommonEnums::$pageSizeOfAdmin;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $usersModel->findAll($criteria);

        return ['list'=>$list, 'pages'=>$pages];
    }
}