<?php
/**
 * 公共参数文件
 */

class CommonEnums
{
    //后台分页配置
    public static $pageSizeOfAdmin = 20;

    /**
     * 获取当前时间字符串
     * @return false|string
     */
    public static function getNowDateTime(){
        return date('Y-m-d H:i:s');
    }

    /**
     * 学生年级
     * @return array
     */
    public static function getGradeIdList(){
        return [
            1 => '幼儿园',
            2 => '一年级',
            3 => '二年级',
            4 => '三年级',
            5 => '四年级',
            6 => '五年级',
            7 => '六年级',
            8 => '初一',
            9 => '初二',
            10 => '初三',
            11 => '高一',
            12 => '高二',
            13 => '高三',
        ];
    }
}