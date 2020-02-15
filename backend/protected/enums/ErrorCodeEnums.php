<?php
/**
 * 错误码
 */

class ErrorCodeEnums
{
    //OK
    public static $OK = 200;
    public static $OK_MSG = 'success';

    //Error
    public static $ERROR = 500;
    public static $ERROR_MSG = 'error';

    //Params error
    public static $PARAMS_ERROR = 300;
    public static $PARAMS_ERROR_MSG = '参数错误';

    /**
     * 根据错误码返回错误信息
     * @param $code
     * @return string
     */
	public static function getMsgByCode($code){
	    switch ($code){
            case self::$ERROR:
                return self::$ERROR_MSG;
            case self::$OK:
                return self::$OK_MSG;
            case self::$PARAMS_ERROR:
                return self::$PARAMS_ERROR_MSG;
        }
    }

}