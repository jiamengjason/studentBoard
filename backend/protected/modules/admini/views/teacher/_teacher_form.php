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
        <td class="tb_title">教师姓名：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'user_name',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <?php if ($model->isNewRecord):?>
    <tr>
        <td class="tb_title">教师手机号：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'mobile',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">教师邮箱：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'email',array('size'=>50, 'class'=>'validate[required]')); ?></td>
    </tr>
    <tr>
        <td class="tb_title">教师登陆密码：</td>
    </tr>
    <tr >
        <td ><?php echo $form->textField($model,'password',array('size'=>50, 'class'=>'validate[required]', 'value'=>123456)); ?></td>
    </tr>
    <?php endif?>
    <tr>
        <td class="tb_title">所属机构：</td>
    </tr>
    <tr >
        <td >
            <select name="Users[parent_id]">
                <?php foreach((array)$model->organizationList as $item):?>
                    <option value="<?php echo $item['id']?>" <?php XUtils::selected($item['id'], $model->parent_id);?>><?php echo $item['organization_name']?></option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tb_title">教师身份证件：</td>
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
        <td class="tb_title">账号状态：</td>
    </tr>
    <tr >
        <td ><?php echo $form->dropDownList($model,'status_is',array('1'=>'正常', '0'=>'禁用')); ?></td>
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
