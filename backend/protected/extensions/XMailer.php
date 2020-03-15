<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once 'phpMailer/src/PHPMailer.php';
require_once 'phpMailer/src/SMTP.php';
require_once 'phpMailer/src/Exception.php';

/**
 * XMailer工具类
 *
 */
class XMailer{
    private $phpMailer;
    public $from = '';
    private $_preSubject = '[系统消息]';

    public function __construct()
    {
        //初始化邮箱服务
        $this->phpMailer = new PHPMailer(true);
        $this->phpMailer->isSMTP();
        $this->phpMailer->CharSet = 'UTF-8';
        $this->phpMailer->Host = 'smtp.163.com';
        $this->phpMailer->SMTPAuth = true;
        $this->phpMailer->Username = 'jiameng_jason';
        $this->phpMailer->Password = '5566183m';
        $this->phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->phpMailer->Port = 465;
    }

    /**
     * 给邮箱发送验证码
     * @param $address
     * @param $code
     * @return bool
     * @throws Exception
     */
	public function sendMailForValidateCode ($address, $code){
	    $this->phpMailer->setFrom($this->from, $this->_preSubject.'StudentBoard');
	    $this->phpMailer->addAddress($address);
	    $this->phpMailer->isHTML(true);
	    $this->phpMailer->Subject = 'StudentBoard-邮箱找回密码';
	    $this->phpMailer->Body = '验证码：'.$code;
	    try{
	        return $this->phpMailer->send();
        }catch (\Exception $e){
	        return false;
        }
	}
}


