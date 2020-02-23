<?php if (CHtml::errorSummary($model)):?>
<table id="tips">
  <tr>
    <td><div class="erro_div"><span class="error_message">
       <?php echo CHtml::errorSummary($model); ?>
        </span></div></td>
  </tr>
</table>
<?php endif?>
<?php $form=$this->beginWidget('CActiveForm',array('id'=>'xform','htmlOptions'=>array('name'=>'xform'))); ?>
<table class="form_table">
    <tr>
        <td class="tb_title">学生姓名：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'user_name',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <?php if ($model->isNewRecord):?>
    <tr>
        <td class="tb_title">学生手机号：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'mobile',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">学生邮箱：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'email',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">学生登陆密码：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'password',array('size'=>50, 'class'=>'validate[required]', 'value'=>123456)); ?></td>
    </tr>
    <?php endif?>
    <tr>
        <td class="tb_title">学生在读学校：</td>
    </tr>
    <tr >
        <td >
            <?php echo $form->textField($model,'school_name',array('size'=>50, 'class'=>'validate[required]')); ?>&nbsp;&nbsp;
            <select name="Users[grade]">
                <option value="0">--年级--</option>
                <?php foreach((array)$model->gradeIdList as $gradeId=>$gradeName):?>
                    <option value="<?php echo $gradeId?>" <?php XUtils::selected($gradeId, $model->grade);?>><?php echo $gradeName?></option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tb_title">学生身份证件：</td>
    </tr>
    <tr >
        <td >
            <?php
                if (!empty($model->identity_img)){
                    echo '<img src="'.$model->identity_img.'" width="300" />';
                }else {
                    echo '<img src="'.$this->_baseUrl.'/static/admin/images/default_head_img.jpg" width="300" />';
                }
            ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title">学生证：</td>
    </tr>
    <tr >
        <td >
            <?php
                if (!empty($model->student_card_img)){
                    echo '<img src="'.$model->student_card_img.'" width="300" />';
                }else {
                    echo '<img src="'.$this->_baseUrl.'/static/admin/images/default_head_img.jpg" width="300" />';
                }
            ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title">账号状态：</td>
    </tr>
    <tr >
        <td ><?php echo $form->dropDownList($model,'status_is',array('1'=>'正常', '0'=>'禁用')); ?></td>
    </tr>
    <tr class="submit">
        <td > <input name="submit" type="submit" id="submit" value="提交" class="button" /></td>
    </tr>
</table>

<script type="text/javascript">
$(function(){
	$("#xform").validationEngine();	
});
</script>
<?php $form=$this->endWidget(); ?>
