<?php

class LoginService
{
    //token有效期
    private $tokenLifeTime = 3600;



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

    /**
     * 判断手机号是否唯一
     * @param $mobile
     * @return bool
     */
    public function validateMobileUnique($mobile){
        $bool = false;
        if (empty($mobile)){
            return $bool;
        }

        $usersModel = new Users();
        $rs = $usersModel->findByConditions('mobile=:mobile', ['mobile'=>$mobile]);
        if (!empty($rs)){
            $bool = true;
        }

        return $bool;
    }

    /**
     * 判断邮箱是否唯一
     * @param $email
     * @return bool
     */
    public function validateEmailUnique($email){
        $bool = false;
        if (empty($email)){
            return $bool;
        }

        $usersModel = new Users();
        $rs = $usersModel->findByConditions('email=:email', ['email'=>$email]);
        if (!empty($rs)){
            $bool = true;
        }

        return $bool;
    }

    /**
     * 登陆接口
     * @param $mobile
     * @param $password
     * @return bool
     */
    public function doLogin($mobile, $password){
        $password = md5($password);

        $usersModel = new Users();
        $rs = $usersModel->find('(mobile=:mobile or email=:email) and password=:password', ['mobile'=>$mobile, 'email'=>$mobile, 'password'=>$password]);
        if (empty($rs)){
            return false;
        }else {
            return $rs;
        }
    }

    /**
     * 生成token
     * @param $users
     * @return array|bool
     */
    public function createToken($users){
        $return = [];

        $time = time();
        $expireTime = $time + $this->tokenLifeTime;
        $mobile = $users['mobile'];
        $roleId = $users['role_id'];
        $userId = $users['id'];

        $tokenKey = $userId.'_'.$mobile.'_'.$roleId.'_'.$time;
        $token = md5($tokenKey);
        //判断用户token信息是否存在，否则更新
        $tokenModel = new Token();
        $rs = $tokenModel->findByConditions('user_id=:user_id', ['user_id'=>$userId]);
        if (!empty($rs)){
            $bool = $tokenModel->updateByPk($rs['id'], ['token'=>$token, 'expire_time'=>$expireTime]);
        }else {
            $tokenModel->setAttributes([
                'user_id' => $userId,
                'token_key' => $tokenKey,
                'token' => $token,
                'expire_time' => $expireTime,
                'create_time' => $time
            ]);
            $bool = $tokenModel->save();
        }
        if ($bool){
            $return['token'] = $token;
        }else {
            return false;
        }
        $return['user_id'] = $userId;

        return $return;
    }
}