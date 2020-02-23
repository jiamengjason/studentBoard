<?php $this->renderPartial('/_include/header');?>

<div id="contentHeader">
  <h3>机构列表</h3>
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
        <th width="80">负责人用户ID</th>
        <th width="">机构信息</th>
        <th width="100">负责人姓名</th>
        <th width="100">负责人手机号</th>
        <th width="180">负责人邮箱</th>
        <th width="90">是否验证手机号</th>
        <th width="60">用户状态</th>
        <th width="140">注册时间</th>
        <th width="80">操作</th>
    </tr>
    <?php foreach ($datalist as $row):?>
    <tr class="tb_list">
        <td ><?php echo $row->id?></td>
        <td ><?php echo $row->organization_name?><br />
        <?php echo $row->organization_email?></td>
        <td ><?php echo $row->user_name?></td>
        <td ><?php echo $row->mobile?></td>
        <td ><?php echo $row->email?></td>
        <td> <?php echo $row->mobile_vali == 1 ? '是' : '否'?></td>
        <td> <?php echo $row->status_is == 1 ? '正常' : '禁用'?></td>
        <td ><?php echo $row->create_time?></td>
        <td ><a href="<?php echo  $this->createUrl('update',array('id'=>$row->id))?>"><img src="<?php echo $this->_baseUrl?>/static/admin/images/update.png" align="absmiddle" /></a>&nbsp;&nbsp;<a href="<?php echo  $this->createUrl('batch',array('command'=>'adminDelete', 'id'=>$row->id))?>" class="confirmSubmit"><img src="<?php echo $this->_baseUrl?>/static/admin/images/delete.png" align="absmiddle" /></a></td>
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
