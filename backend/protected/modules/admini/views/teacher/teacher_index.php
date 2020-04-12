<?php $this->renderPartial('/_include/header');?>

<div id="contentHeader">
  <h3>教师列表</h3>
  <div class="searchArea">
    <ul class="action left" >
      <li><a href="<?php echo $this->createUrl('create')?>" class="actionBtn"><span>录入</span></a></li>
    </ul>
    <div class="search right"> </div>
  </div>
</div>
<table class="content_list">
  <form method="post" action="" name="cpform">
    <tr class="tb_header">
        <th width="80">教师ID</th>
        <th width="">所属机构</th>
        <th width="100">教师姓名</th>
        <th width="100">教师手机号</th>
        <th width="180">教师邮箱</th>
        <th width="90">已验证手机号</th>
        <th width="60">用户状态</th>
        <th width="140">注册时间</th>
        <th width="100">推荐到首页</th>
        <th width="80">操作</th>
    </tr>
    <?php foreach ($datalist as $row):?>
    <tr class="tb_list">
        <td ><?php echo $row->id?></td>
        <td ><?php if (isset($organizationList[$row->parent_id])) echo $organizationList[$row->parent_id]?></td>
        <td ><?php echo $row->user_name?></td>
        <td ><?php echo $row->mobile?></td>
        <td ><?php echo $row->email?></td>
        <td> <?php echo $row->mobile_vali == 1 ? '是' : '否'?></td>
        <td> <?php echo $row->status_is == 1 ? '正常' : '禁用'?></td>
        <td ><?php echo $row->create_time?></td>
        <td> <?php echo $row->is_command == 1 ? '是' : '否'?></td>
        <td >
            <a href="<?php echo  $this->createUrl('update',array('id'=>$row->id))?>">
                <img src="<?php echo $this->_baseUrl?>/static/admin/images/update.png" align="absmiddle" />
            </a>&nbsp;&nbsp;
            <a href="<?php echo  $this->createUrl('batch',array('command'=>'delete', 'id'=>$row->id))?>" class="confirmSubmit">
                <img src="<?php echo $this->_baseUrl?>/static/admin/images/delete.png" align="absmiddle" />
            </a>
        </td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="9">
            <div class="cuspages right"><?php $this->widget('CLinkPager',array('pages'=>$pagebar));?></div>
        </td>
    </tr>
  </form>
</table>
<?php $this->renderPartial('/_include/footer');?>
