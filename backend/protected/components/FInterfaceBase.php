<?php

/**
 * 控制器基类，前台控制器必须继承此类
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class FInterfaceBase extends Controller
{
    public $layout = '';
    protected $_conf;
    protected $_catalog;
    protected $_seoTitle;
    protected $_seoKeywords;
    protected $_seoDescription;
    protected $_roleGroupList;

    /**
	 * 初始化
	 * @see CController::init()
	 */
    public function init ()
    {
        parent::init();

        //检测系统是否已经安装
        if(!is_file(WWWPATH.DS.'data'.DS.'install.lock'))
            $this->redirect(array('/install'));
        //系统配置
        $this->_conf = XXcache::system('_config');
        $this->_catalog = Catalog::get(0, XXcache::system('_catalog'));
        $this->_seoTitle = $this->_conf['seo_title'];
        $this->_seoKeywords = $this->_conf['seo_keywords'];
        $this->_seoDescription = $this->_conf['seo_description'];
        $this->_roleGroupList = RoleGroupListConfig::getRoleIdList();
        if($this->_conf['site_status'] == 'close')
            self::_closed();
    }

    /**
     * 关闭状态
     */
    protected function _closed(){
        return $this->outputError();
    }

    /**
     * 返回给客户端标准的json字符串
     * @param $code
     * @param $msg
     * @param $data
     */
    private function outputJson($code, $msg, $data){
        $output = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        echo json_encode($output);
        exit;
    }

    /**
     * 输出成功
     * @param string $msg
     * @param array $data
     */
    public function outputOk($msg = '', $data = []){
        $code = ErrorCodeEnums::$OK;
        $msg = empty($msg) ? ErrorCodeEnums::getMsgByCode($code) : $msg;
        return $this->outputJson($code, $msg, $data);
    }

    /**
     * 输出错误
     * @param string $msg
     * @param array $data
     */
    public function outputError($msg = '', $data = []){
        $code = ErrorCodeEnums::$ERROR;
        $msg = empty($msg) ? ErrorCodeEnums::getMsgByCode($code) : $msg;
        return $this->outputJson($code, $msg, $data);
    }

    /**
     * 输出参数错误
     * @param string $msg
     * @param array $data
     */
    public function outputParamsError($msg = '', $data = []){
        $code = ErrorCodeEnums::$PARAMS_ERROR;
        $msg = empty($msg) ? ErrorCodeEnums::getMsgByCode($code) : $msg;
        return $this->outputJson($code, $msg, $data);
    }
}