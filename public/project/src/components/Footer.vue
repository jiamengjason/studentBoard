<template>
  <div class="Footer">
    <div class="container">
      <el-menu :default-active="activeIndex" class="footerMenu" mode="horizontal" @select="handleSelect">
        <el-menu-item index="1"><router-link to="comingSoon">关于我们</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="comingSoon">商务合作</router-link></el-menu-item>
        <el-menu-item index="3"><router-link to="comingSoon">广告服务</router-link></el-menu-item>
        <el-menu-item index="4"><router-link to="comingSoon">客服中心</router-link></el-menu-item>
        <el-menu-item index="5"><router-link to="comingSoon">在线留言</router-link></el-menu-item>
        <el-menu-item index="6"><router-link to="comingSoon">合作伙伴</router-link></el-menu-item>
        <el-menu-item index="7"><router-link to="comingSoon">联系我们</router-link></el-menu-item>
      </el-menu>
      <p>
        <span>Copyright</span>
        <span>2007-2018,All Rights Reserve 网站建设</span>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Footer'
}
</script>
<style lang="scss">
.Footer{
  margin-top: 20px;
  text-align: center;
  color: #ffffff;
  padding: 50px 0;
  p{
    line-height: 24px;
  }
  .footerMenu{
    background: none;
    display: inline-table;
    .el-menu-item{
      &:hover,&:focus{
        background: none!important;
        a{
          text-decoration: underline;
        }
      }
    }
    a{
      color: #ffffff!important;
      display: inline-block;
      width: 100%;
      height: 100%;
    }
  }
}
</style>
