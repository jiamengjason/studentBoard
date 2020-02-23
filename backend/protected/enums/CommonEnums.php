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
}