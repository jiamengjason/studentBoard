<?php
/**
 * "{{active}}" 数据表模型类.
 */
class EvaluateScore extends XBaseModel
{
    public $organizationList;
    public $gradeIdList;
	
	/**
	 * @return string 相关的数据库表的名称
	 */
	public function tableName()
	{
		return '{{evaluate_score}}';
	}

	/**
	 * @return array 对模型的属性验证规则.
	 */
	public function rules()
	{
        return array(
            array('evaluated_uid,user_id,score,is_recommend,tags,comment', 'required'),
            array('evaluated_uid,user_id,score,is_recommend,tags,comment,give_like,give_dislike', 'safe'),
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

    /**
     * 根据查询条件返回记录数
     * @param string $condition
     * @param array $params
     * @return CActiveRecord
     */
    public function findByConditions($condition = '', $params = array())
    {
        return parent::find($condition, $params); // TODO: Change the autogenerated stub
    }
}
