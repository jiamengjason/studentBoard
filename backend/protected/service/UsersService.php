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

    /**
     * 根据uid查询用户信息
     * @param $uid
     * @return array|CActiveRecord
     */
    public function getUserInfoByUid($uid){
        $data = [];
        if (empty($uid)){
            return $data;
        }

        $userModel = new Users();
        $userInfo = $userModel->findByPk($uid);
        if (!empty($userInfo)) {
            $data['userId'] = $userInfo['id'];
            $data['parentId'] = $userInfo['parent_id'];
            $data['roleId'] = $userInfo['role_id'];
            $data['userName'] = $userInfo['user_name'];
            $data['mobile'] = $userInfo['mobile'];
            $data['email'] = $userInfo['email'];
            $data['realName'] = $userInfo['real_name'];
            $data['schoolName'] = $userInfo['school_name'];
            $data['grade'] = $userInfo['grade'];
            $data['headImg'] = $userInfo['head_img'];
            $data['identityImg'] = $userInfo['identity_img'];
            $data['studentCardImg'] = $userInfo['student_card_img'];
            $data['organizationName'] = $userInfo['organization_name'];
            $data['organizationEmail'] = $userInfo['organization_email'];
            $data['organizationDesc'] = $userInfo['organization_desc'];
            $data['organizationYewu'] = $userInfo['organization_yewu'];
            $data['organizationPhone'] = $userInfo['organization_phone'];
            $data['organizationWww'] = $userInfo['organization_www'];
        }

        return $data;
    }

    /**
     * 保存用户个人信息
     * @param $userId
     * @param $_getsObj
     * @return bool|int
     */
    public function updateUserInfo($userId, $_getsObj){
        $saveFields = [
            'userName'          => 'user_name',
            'realName'          => 'real_name',
            'schoolName'        => 'school_name',
            'grade'             => 'grade',
            'headImg'           => 'head_img',
            'identityImg'       => 'identity_img',
            'studentCardImg'    => 'student_card_img',
            'organizationName'  => 'organization_name',
            'organizationEmail' => 'organization_email',
            'organizationDesc'  => 'organization_desc',
            'organizationYewu'  => 'organization_yewu',
            'organizationPhone' => 'organization_phone',
            'organizationWww'   => 'organization_www'
        ];

        $data = [];
        foreach ($saveFields as $inputField => $saveField){
            if (!empty($_getsObj->getParam($inputField))){
                $data[$saveField] = $_getsObj->getParam($inputField);
            }
        }
        if (empty($data)){
            return false;
        }

        $bool = Users::model()->updateByPk($userId, $data);
        if ($bool){
            return true;
        }
        return false;
    }
}