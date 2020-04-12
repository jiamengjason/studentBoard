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
     * 根据条件查询机构名称
     * @param $idsArr
     * @return array|CActiveRecord[]
     */
    public function getOrganizationInfoByIds($idsArr){
        if (empty($idsArr)){
            return [];
        }
        $defaultSelect = 'id,organization_name,organization_desc,organization_yewu,organization_www,organization_phone,head_img';
        //条件
        $where = 'id in ('.implode(',', $idsArr).')';
        $usersModel = new Users();
        $criteria = new CDbCriteria();
        $criteria->condition = $where;
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
            $data['grade_label'] = RoleGroupListConfig::getGradeLabelByGradeId($userInfo['grade']);
            $data['headImg'] = empty($userInfo['head_img']) ? '' : $userInfo['head_img'];
            $data['identityImg'] = $userInfo['identity_img'];
            $data['studentCardImg'] = $userInfo['student_card_img'];
            $data['organizationName'] = $userInfo['organization_name'];
            $data['organizationEmail'] = $userInfo['organization_email'];
            $data['organizationDesc'] = $userInfo['organization_desc'];
            $data['organizationYewu'] = empty($userInfo['organization_yewu']) ? [] : explode(',', $userInfo['organization_yewu']);
            $data['teacherCourse'] = empty($userInfo['teacher_course']) ? [] : explode(',', $userInfo['teacher_course']);
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
            'organizationWww'   => 'organization_www',
            'parentId'          => 'parent_id',
            'teacherCourse'     => 'teacher_course'
        ];

        $data = [];
        foreach ($saveFields as $inputField => $saveField){
            if (!empty($_getsObj[$inputField])){
                $data[$saveField] = $_getsObj[$inputField];
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
                $loginService = new LoginService();
                if (true === $loginService->isUserExsit($data['newEmail'])){
                    $rs = '新的邮箱账号已被注册~';
                    break;
                }
                $validateCodeService = new ValidateCodeService();
                $bool = $validateCodeService->validateByValidate($data['newEmail'], $data['validCode']);
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
                $loginService = new LoginService();
                if (true === $loginService->isUserExsit($data['newMobile'])){
                    $rs = '新的手机账号已被注册~';
                    break;
                }
                $validateCodeService = new ValidateCodeService();
                $bool = $validateCodeService->validateByValidate($data['newMobile'], $data['validCode']);
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

    /**
     * 搜索
     * @param $params
     * @return array
     */
    public function searchByParams($params){
        $pageSize = !isset($params['page_size']) ? CommonEnums::$pageSizeOfAdmin : $params['page_size'];
        $page = !isset($params['page']) ? 1 : $params['page'];
        $limit = ($page - 1) * $pageSize;

        //条件
        $where = '1';
        //检索角色
        if (isset($params['role_id']) && !empty($params['role_id'])){
            $where .= ' and u.role_id = ' .$params['role_id'];
        }else {
            $where .= ' and u.role_id in('.RoleGroupListConfig::$organizationRoleId. ','.RoleGroupListConfig::$teacherRoleId.')';
        }
        //检索老师课程
        if (isset($params['teacher_course']) && !empty($params['teacher_course'])){
            $where .= ' and u.teacher_course like \'%' .$params['teacher_course']. '%\'';
        }
        //检索机构业务
        if (isset($params['organization_yewu']) && !empty($params['organization_yewu'])){
            $where .= ' and u.organization_yewu like \'%' .$params['organization_yewu']. '%\'';
        }

        //order by
        $orderBy = 'order by e.score desc,e.e_num desc';
        //limit
        $limitSql = 'limit '.$limit.','.$pageSize;
        //select
        $sqlCount = 'select count(id) c from sb_users u where '.$where;
        $sql = 'select 
	u.id user_id,u.role_id,u.parent_id,u.user_name,u.head_img,u.teacher_course,u.organization_yewu,IFNULL(e.score, 0.0) as score, IFNULL(e.e_num, 0) as e_num 
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
            $data['total_num'] = intval($countRs[0]['c']);
        }
        $parentIds = array_unique(array_column($userList, 'parent_id'));
        $parentList = [];
        if (!empty($parentIds)){
            foreach ($parentIds as $key=>$pId){
                if (empty($pId)){
                    unset($parentIds[$key]);
                }
            }
            if (!empty($parentList)){
                $parentList = $dbHandel->createCommand('select id,organization_name from sb_users where id in('.implode(',', $parentIds).')')->queryAll();
                $parentList = array_column($parentList, null, 'id');
            }
        }

        $teacherService = new TeachersService();
        //查询明星评价
        $evaluateScoreService = new EvaluateScoreService();
        //遍历
        foreach ($userList as $key=>$item){
            if (isset($parentList[$item['parent_id']])){
                $userList[$key]['organization_name'] = $parentList[$item['parent_id']]['organization_name'];
            }
            $userList[$key]['teacher_course'] = !empty($item['teacher_course']) ? explode(',', $item['teacher_course']) : [];
            $userList[$key]['organization_yewu'] = !empty($item['organization_yewu']) ? explode(',', $item['organization_yewu']) : [];
            //机构获取团队老师
            if ($item['role_id'] == RoleGroupListConfig::$organizationRoleId){
                $userList[$key]['teacher_list'] = $teacherService->getTeachersListByOrganizationId($item['user_id']);

            }elseif ($item['role_id'] == RoleGroupListConfig::$teacherRoleId){
                //老师获取明星评价
                $comment = $evaluateScoreService->getStartCommentList(['evaluated_uid'=>$item['user_id']]);
                $userList[$key]['comment'] = $comment ? $comment['comment'] : '';
            }
        }

        $data['page_count'] = $totalNum;
        $data['page'] = $page;
        $data['page_size'] = $pageSize;
        $data['list'] = $userList;
        return $data;
    }
}