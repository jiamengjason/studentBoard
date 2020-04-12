<?php

class CommonService
{
    /**
     * 获取人机交互随机背景图片地址
     * @return string
     */
    public function getCaptchaImage(){
        $fileList = XUtils::getFile(WWWPATH.DS.'uploads'.DS.'captcha');
        $randomKey = array_rand($fileList);


        return Yii::app()->request->hostInfo . '/uploads/captcha/'.$fileList[$randomKey];
    }

}