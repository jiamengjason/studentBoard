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
            'p_id',  //父类id
        ];
        foreach ($collectionFields as $fields){
            if (isset($_POST[$fields])){
                $params[$fields] = trim($_POST[$fields]);
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

        //判断手机号是否已经注册
        $loginService = new LoginService();
        if ($loginService->validateMobileUnique($params['mobile'])){
            $this->outputParamsError('手机号已经注册');
        }
        //判断邮箱是否已经注册
        if ($loginService->validateEmailUnique($params['email'])){
            $this->outputParamsError('邮箱已经注册');
        }
        //判断验证码是否
        $validateCodeService = new ValidateCodeService();
        if ($validateCodeService->validateByValidate($params['mobile'], $params['valid_code']) == false){
            $this->outputParamsError('验证码错误');
        }

        //去注册
        $rs = $loginService->doRegister($params);
        if (true === $rs){
            $this->outputOk('', $rs);
        }else {
            $this->outputError();
        }
    }

    /**
     * 获取手机验证码
     */
    public function actionGetValidCodeByMobile(){
        $mobile = $_POST['mobile']; //手机号
        if (empty($mobile) || strlen($mobile) != 11){
            $this->outputError('手机号格式错误');
        }

        $validateCodeService = new ValidateCodeService();
        $code = $validateCodeService->getCodeByMobile($mobile);
        //获取失败
        if (false === $code){
            $this->outputError('获取验证码失败，请重试');
        }

        //成功返回验证码
        $this->outputOk('', ['valid_code'=>$code]);
    }

    /**
     * 登陆接口
     */
    public function actionDo(){
        $mobile = trim($_POST['mobile']);
        $password = trim($_POST['password']);

        if (empty($mobile)){
            $this->outputParamsError('请输入手机号或邮箱账号');
        }
        if (empty($password)){
            $this->outputParamsError('请输入密码');
        }

        //去登陆
        $loginService = new LoginService();
        $rs = $loginService->doLogin($mobile, $password);
        if (false === $rs){
            $this->outputError('用户名或密码错误');
        }else if ($rs->status_is == 0){
            $this->outputError('用户已禁用');
        }
        //登陆成功，去生成token
        $rs = $loginService->createToken($rs);
        if (false === $rs){
            $this->outputError('登陆失败');
        }else {
            $this->outputOk('', $rs);
        }
    }

    /**
     * 通过手机号找回密码
     */
    public function actionResetPwByMobile(){
        $mobile = trim($_POST['mobile']);
        $validateCode = trim($_POST['validate_code']);
        $newPassword = trim($_POST['new_password']);
        $rePassword = trim($_POST['re_password']);

        if (empty($mobile)){
            $this->outputParamsError('请输入手机号');
        }
        if (empty($validateCode)){
            $this->outputParamsError('请输入验证码');
        }
        //用户是否存在
        $loginService = new LoginService();
        if (false === $loginService->isUserExsit($mobile)){
            $this->outputError('手机号未注册');
        }
        //验证码是否正确
        $validateCodeService = new ValidateCodeService();
        $rs = $validateCodeService->validateByValidate($mobile, $validateCode);
        if (false == $rs){
            $this->outputError('验证码错误');
        }
        //重复密码是否相等
        if ($newPassword != $rePassword){
            $this->outputError('密码不一致');
        }

        $bool = $loginService->resetPasswordByMobileOrEmail($mobile, $newPassword);
        if (true === $bool){
            $this->outputOk('密码设置成功');
        }else {
            $this->outputError($bool);
        }
    }

    /**
     * 获取邮箱验证码
     */
    public function actionGetValidCodeByEmail(){
        $email = $_POST['email']; //邮箱
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            $this->outputError('无效的Email格式');
        }
        //用户是否存在
        $loginService = new LoginService();
        if (false === $loginService->isUserExsit($email)){
            $this->outputError('邮箱未注册');
        }

        //获取验证码
        $validateCodeService = new ValidateCodeService();
        $code = $validateCodeService->getCodeByEmail($email, $this->_conf['admin_email']);
        if (false === $code){
            $this->outputError('获取验证码失败，请重试');
        }

        //成功返回验证码
        $this->outputOk('已经向您的邮箱：'.$email.'成功发送验证码，请查收');
    }

    /**
     * 通过邮箱找回密码
     */
    public function actionResetPwByEmail(){
        $email = trim($_POST['email']);
        $validateCode = trim($_POST['validate_code']);
        $newPassword = trim($_POST['new_password']);
        $rePassword = trim($_POST['re_password']);

        if (empty($email)){
            $this->outputParamsError('请输入邮箱');
        }
        if (empty($validateCode)){
            $this->outputParamsError('请输入验证码');
        }
        //用户是否存在
        $loginService = new LoginService();
        if (false === $loginService->isUserExsit($email)){
            $this->outputError('邮箱未注册');
        }
        //验证码是否正确
        $validateCodeService = new ValidateCodeService();
        $rs = $validateCodeService->validateByValidate($email, $validateCode);
        if (false == $rs){
            $this->outputError('验证码错误');
        }
        //重复密码是否相等
        if ($newPassword != $rePassword){
            $this->outputError('密码不一致');
        }

        $bool = $loginService->resetPasswordByMobileOrEmail($email, $newPassword);
        if (true === $bool){
            $this->outputOk('密码设置成功');
        }else {
            $this->outputError($bool);
        }
    }
}