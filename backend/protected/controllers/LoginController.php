<?php
/**
 * 登陆注册接口
 */

class LoginController extends FInterfaceBase
{

    /**
     * 注册账号
     */
    public function actionRegister (){
        $params = [];
        //$_POST
        $collectionFields = [
            'role_id',          //账户类型
            'user_name',        //姓名
            'mobile',           //手机号码
            'password',         //密码
            're_password',      //重复密码
            'email',            //邮箱
            'school_name',      //在读学校
            'grade',            //年级
            'identity_img',     //身份证附件
            'student_card_img', //学生证附件
            'parent_id',        //所属机构
            'organization_name',//机构名称
            'organization_desc',//机构简介
            'valid_code',       //手机验证码
        ];
        foreach ($collectionFields as $fields){
            if (isset($_POST[$fields])){
                $params[$fields] = $_POST[$fields];
            }
        }
        if (!isset($params['role_id']) || empty($params['role_id'])){
            $this->outputParamsError('请选择账户类型');
        }
        if (!isset($params['user_name']) || empty($params['user_name'])){
            $this->outputParamsError('请输入姓名');
        }
        if (!isset($params['mobile']) || empty($params['mobile'])){
            $this->outputParamsError('请输入手机号');
        }
        if (!isset($params['email']) || empty($params['email'])){
            $this->outputParamsError('请输入邮箱');
        }
        if (!isset($params['valid_code']) || empty($params['valid_code'])){
            $this->outputParamsError('请输入手机验证码');
        }
        if (!isset($params['password']) || empty($params['password'])){
            $this->outputParamsError('密码不能为空');
        }
        if (!isset($params['re_password']) || empty($params['re_password'])){
            $this->outputParamsError('重复密码不能为空');
        }
        if ($params['password'] != $params['re_password']){
            $this->outputParamsError('密码不一致');
        }
        //学生账号
        $loginService = new LoginService();
        $rs = $loginService->doRegister($params);

        if (true === $rs){
            $this->outputOk();
        }else {
            $this->outputError();
        }
    }

    /**
     * 获取手机验证码
     */
    public function actionGetValidCode(){
        $mobile = $_POST['mobile']; //手机号
        if (empty($mobile) || strlen($mobile) != 11){
            $this->outputError('手机号格式错误');
        }

        $validCode = '389210';
        $this->outputOk('', ['valid_code'=>$validCode]);
    }

}