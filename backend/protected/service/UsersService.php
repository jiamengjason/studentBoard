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

        Users::model()->updateByPk($userId, $data);
        return true;
    }

    //【个人中心】修改用户绑定信息
    public function updateUserUnionInfo($userInfo, $data){
        $rs = null;

        $userId = $userInfo['id'];
        $type = $data['type'];
        switch ($type){
            case 1: //修改密码
                //判断原密码是否正确
                if (CommonEnums::md5Password($data['oldPassword']) != $userInfo['password']){
                    $rs = '原密码错误';
                    return $rs;
                }
                $save = [
                    'password' => CommonEnums::md5Password($data['newPassword'])
                ];
                $bool = Users::model()->updateByPk($userId, $save);
                if ($bool){
                    $rs = true;
                }else {
                    $rs = '密码修改失败，请重试';
                }
                break;
            case 2: //修改邮箱
                $validateCodeService = new ValidateCodeService();
                $bool = $validateCodeService->validateByValidate($userInfo['email'], $data['validCode']);
                if ($bool == true){
                    $save = [
                        'email' => $data['newEmail']
                    ];
                    $bool = Users::model()->updateByPk($userId, $save);
                    if ($bool){
                        $rs = true;
                    }else {
                        $rs = '邮箱修改失败，请重试';
                    }
                }else{
                    $rs = '校验码错误';
                }
                break;
            case 3: //修改手机
                $validateCodeService = new ValidateCodeService();
                $bool = $validateCodeService->validateByValidate($userInfo['mobile'], $data['validCode']);
                if ($bool == true){
                    $save = [
                        'mobile' => $data['newMobile']
                    ];
                    $bool = Users::model()->updateByPk($userId, $save);
                    if ($bool){
                        $rs = true;
                    }else {
                        $rs = '手机号修改失败，请重试';
                    }
                }else{
                    $rs = '校验码错误';
                }
                break;
        }

        return $rs;
    }
}