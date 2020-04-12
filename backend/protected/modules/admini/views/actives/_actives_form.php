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
        <td class="tb_title">活动名称：</td>
    </tr>
    <tr >
        <td ><?php echo $model->title; ?></td>
    </tr>
    <tr>
        <td class="tb_title">推荐到首页：</td>
    </tr>
    <tr >
        <td ><?php echo $form->dropDownList($model,'is_command',array('0'=>'否', '1'=>'是')); ?></td>
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
