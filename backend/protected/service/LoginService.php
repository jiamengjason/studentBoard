<?php

class LoginService
{
    //可以保持的字段
    private $saveFields = [
        'role_id',          //账户类型
        'user_name',        //姓名
        'mobile',           //手机号码
        'password',         //密码
        'email',            //邮箱
        'school_name',      //在读学校
        'grade',            //年级
        'identity_img',     //身份证附件
        'student_card_img', //学生证附件
        'parent_id',        //所属机构
        'organization_name',//机构名称
        'organization_desc',//机构简介
    ];

    /**
     * 保存用户
     * @param $params
     * @return bool
     */
    public function doRegister($params){
        $save = [];
        foreach ($this->saveFields as $field){
            if (isset($params[$field])){
                $save[$field] = $params[$field];
            }
        }
        if (isset($save['password'])){
            $save['password'] = md5($save['password']);
        }
        $save['status_is'] = 1;

        $usersModel = new Users();
        $usersModel->setAttributes($save);
        return $usersModel->save();
    }
}