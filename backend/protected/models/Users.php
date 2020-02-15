<?php
/**
 * "{{users}}" 数据表模型类.
 *
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Model
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */
class Users extends XBaseModel
{
	
	/**
	 * @return string 相关的数据库表的名称
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array 对模型的属性验证规则.
	 */
	public function rules()
	{
        return array(
            array('role_id,user_name,mobile,email,password', 'required'),
            array('email', 'email'),
            array('parent_id,role_id,user_name,mobile,email,mobile_vali,email_vali,password,real_name,school_name,grade,head_img,identity_img,student_card_img,organization_name,organization_desc,last_login_ip,last_login_time,login_count,status_is,create_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
//            array('id, post_id, user_id, nickname, email, content, status_is, status_answer, answer_content, client_ip, create_time', 'safe', 'on'=>'search'),
        );
	}

	/**
	 * @return array 关联规则.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(

        );
	}

	/**
	 * @return array 自定义属性标签 (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => '上级分类',
			'create_time' => '录入时间',
		);
	}


	/**
	 * 返回指定的AR类的静态模型.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * 数据保存前处理
     * @return boolean.
     */
    protected function beforeSave ()
    {
        if ($this->isNewRecord) {
            $this->create_time = date('Y-m-d H:i:s');
        }
        return true;
    }
}
