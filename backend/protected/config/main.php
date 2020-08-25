<?php
/**
 * 系统配置
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Config
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'BageCMS',
    'language'=>'zh_cn',
    'theme'=>'default',
    'timeZone'=>'Asia/Shanghai',
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.enums.*',
		'application.service.*',
	),
    'modules'=>array(
		'admini'=>array(
		     'class'=>'application.modules.admini.AdminiModule',
		),
		'account'=>array(
		     'class'=>'application.modules.account.AccountModule',
		)
	),
	'components'=>array(
        'cache'=>array(
           'class'=>'CFileCache',
        ),
		'db'=>array(
		    //测试阿里云RDS链接地址
			'connectionString' => 'mysql:host=localhost;dbname=student_board',
//			'connectionString' => 'mysql:host=rm-bp10436z81762jp2t6o.mysql.rds.aliyuncs.com;dbname=student_board',
            //studentBoard线上阿里云RDS链接地址
//            'connectionString' => 'mysql:host=rm-bp1z4ue2osq9km40zjo.mysql.rds.aliyuncs.com;dbname=student_board',
			//studentBoard线上阿里云ECS登录地址：ssh root@182.92.102.117 ZhixiaGroup2020!
			'emulatePrepare' => true,
			'enableParamLogging' => true,
			'enableProfiling'=>true,
			'username' => 'root',
			'password' => '88888888',
			'charset' => 'utf8',
			'tablePrefix' => 'sb_',
		),
		'errorHandler'=>array(
            'errorAction'=>'error/index',
        ), 
        'urlManager'=>array(
        	//'urlFormat'=>'path',
        	//'urlSuffix'=>'.html',
        	'showScriptName'=>true,
        	'rules'=>array(
        		'post/<id:\d+>/*'=>'post/show',
        		'post/<id:\d+>_<title:\w+>/*'=>'post/show',
        		'post/catalog/<catalog:[\w-_]+>/*'=>'post/index',
        		'page/show/<name:\w+>/*'=>'page/show',
        		'special/show/<name:[\w-_]+>/*'=>'special/show',
        		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
	),
	'params'=> require(dirname(__FILE__).DS.'params.php'),
);