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
        $code = '';
        $numArr = range(0, 9);

        for ($i = 0; $i < 6; $i++){
            $code .= array_rand($numArr);
        }

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
        if (!empty($rs) && $rs['validate_code'] == $validateCode){
            $bool = true;
        }

        return $bool;
    }
}