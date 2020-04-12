<?php $this->renderPartial('/_include/header');?>

<div id="contentHeader">
  <h3>活动列表</h3>
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
        <th width="80">活动ID</th>
        <th width="">活动名称</th>
        <th width="100">活动海报</th>
        <th width="100">发布机构</th>
        <th width="100">活动地址</th>
        <th width="180">活动开始/结束时间</th>
        <th width="60">活动状态</th>
        <th width="100">推荐到首页</th>
        <th width="80">操作</th>
    </tr>
    <?php foreach ($datalist as $row):?>
    <tr class="tb_list">
        <td ><?php echo $row['active_id']?></td>
        <td ><?php echo $row['title']?></td>
        <td ><?php echo $row['title_img']?></td>
        <td ><?php echo $row['organization_name']?></td>
        <td ><?php echo $row['addr']?></td>
        <td ><?php echo $row['start_time'].'<br>'.$row['end_time']?></td>
        <td> <?php echo $row['status'] == 1 ? '进行中' : $row['status'] == 2 ? '未开始' : '已结束'?></td>
        <td> <?php echo $row['is_command'] == 1 ? '是' : '否'?></td>
        <td >
            <a href="<?php echo  $this->createUrl('update',array('id'=>$row['active_id']))?>">
                <img src="<?php echo $this->_baseUrl?>/static/admin/images/update.png" align="absmiddle" />
            </a>&nbsp;&nbsp;
            <a href="<?php echo  $this->createUrl('batch',array('command'=>'delete', 'id'=>$row['active_id']))?>" class="confirmSubmit">
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
