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
        <td class="tb_title">机构名称：</td>
    </tr>
    <tr>
        <td >
            <?php echo $form->textField($model,'organization_name',array('size'=>50, 'class'=>'validate[required]')); ?>
        </td>
    </tr>
    <tr>
        <td class="tb_title">机构简介：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textArea($model,'organization_desc',array('style'=>'width:406px;height:80px;')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">机构邮箱：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'organization_email',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">负责人姓名：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'user_name',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <?php if ($model->isNewRecord):?>
    <tr>
        <td class="tb_title">负责人手机号：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'mobile',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">负责人邮箱：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'email',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">负责人登陆密码：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'password',array('size'=>50, 'class'=>'validate[required]', 'value'=>123456)); ?></td>
    </tr>
    <?php endif?>
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
