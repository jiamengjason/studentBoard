<?php

class CommonService
{
    /**
     * 获取人机交互随机背景图片地址
     * @return string
     */
    public function getCaptchaImage(){
        $imagePath = WWWPATH.DS.'uploads'.DS.'captcha'.DS;
        $fileList = XUtils::getFile($imagePath);
        $randomKey = array_rand($fileList);

        $randomImage = $imagePath.$fileList[$randomKey];

        return $this->base64EncodeImage($randomImage);
    }

    private function base64EncodeImage($image_file) {
        $image_info = getImageSize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' .chunk_split(base64_encode($image_data));
        return $base64_image;
    }
}