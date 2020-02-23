<?php

class UsersService
{

    /**
     * 获取用户列表
     * @return array
     */
    public function adminGetUsersPageList($roleId){
        $usersModel = new Users();
        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $criteria->condition = 'role_id = ' . $roleId;
        $count = $usersModel->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = CommonEnums::$pageSizeOfAdmin;
        $criteria->limit = $pages->pageSize;
        $criteria->offset = $pages->currentPage * $pages->pageSize;
        $list = $usersModel->findAll($criteria);

        return ['list'=>$list, 'pages'=>$pages];
    }

    /**
     * 根据条件查询用户
     * @param $conditions
     * @param string $select
     * @param string $orderBy
     * @return array|CActiveRecord[]
     */
    public function getAllUsersByCondition($conditions, $select = '', $orderBy = 't.id DESC'){
        if (empty($conditions)){
            return [];
        }
        $defaultSelect = 'id,parent_id,role_id,user_name,mobile,organization_name,organization_email,status_is';
        //条件
        if (is_array($conditions)){
            $where = [];
            foreach ($conditions as $field=>$value){
                $where[] = $field . '=' . $value;
            }
            $where = implode(' and ', $where);
        }else {
            $where = $conditions;
        }
        $usersModel = new Users();
        $criteria = new CDbCriteria();
        $criteria->condition = $where;
        $criteria->order = 't.id DESC';
        $criteria->select = empty($select) ? $defaultSelect : $select;

        return $usersModel->findAll($criteria);
    }
}