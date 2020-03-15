<?php

/**
 * 手机邮箱验证码相关服务
 * Class ValidateCodeService
 */
class ValidateCodeService
{
    private $fromTypeOfMobile = 1;
    private $fromTypeOfEmail = 2;

    /**
     * 获取手机号验证码
     * @param $mobile
     * @return bool|string
     */
    public function getCodeByMobile($mobile){
        if (empty($mobile)){
            return false;
        }
        $code = '';
        $numArr = range(0, 9);

        for ($i = 0; $i < 6; $i++){
            $randKey = array_rand($numArr);
            $code .= $numArr[$randKey];
        }

        //保存发送code
        $save = [
            'validate' => $mobile,
            'validate_code' => $code,
            'from_type' => $this->fromTypeOfMobile,
            'create_time' => date('Y-m-d H:i:s')
        ];
        $validateCodeModel = new ValidateCode();
        $validateCodeModel->setAttributes($save);
        $bool = $validateCodeModel->save();
        if ($bool){
            return $code;
        }
        return false;
    }

    /**
     * 判断是否能通过验证码
     * @param $validate
     * @param $validateCode
     * @return bool
     */
    public function validateByValidate($validate, $validateCode){
        $bool = false;
        if (empty($validate)){
            return $bool;
        }

        $validateCodeModel = new ValidateCode();
        $sql = "select * from sb_validate_code where validate='$validate' order by id desc limit 1";
        $rs = $validateCodeModel->findBySql($sql);
        if (!empty($rs) && strtolower($rs['validate_code']) == strtolower($validateCode)){
            $bool = true;
        }

        return $bool;
    }

    /**
     * 获取邮箱验证码
     * @param $email
     * @param $fromEmail
     * @return bool|string
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function getCodeByEmail($email, $fromEmail){
        if (empty($email)){
            return false;
        }
        $code = '';
        $numArr = array_merge(range(0, 9), range('A', 'Z'));

        for ($i = 0; $i < 6; $i++){
            $randKey = array_rand($numArr);
            $code .= $numArr[$randKey];
        }

        $save = [
            'validate' => $email,
            'validate_code' => $code,
            'from_type' => $this->fromTypeOfEmail,
            'create_time' => date('Y-m-d H:i:s')
        ];
        $validateCodeModel = new ValidateCode();
        $validateCodeModel->setAttributes($save);
        $bool = $validateCodeModel->save();

        //发送邮件
        $xMailer = new XMailer();
        $xMailer->from = $fromEmail;
        $send = $xMailer->sendMailForValidateCode($email, $code);

        if ($bool && $send){
            return $code;
        }
        return false;
    }
}