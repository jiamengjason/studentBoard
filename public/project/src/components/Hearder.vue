<template>
  <div class="st-header">
    <el-row :gutter="20">
      <el-col :span="7" class="logo">
        <img src="/logo.png" alt="">
      </el-col>
      <el-col :span="11">
        <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
          <el-menu-item index="1">首页</el-menu-item>
          <el-menu-item index="2">著名机构</el-menu-item>
          <el-menu-item index="3">知名教师</el-menu-item>
          <el-menu-item index="4">课外活动</el-menu-item>
          <el-menu-item index="5">留学圈</el-menu-item>
          <el-menu-item index="6">关于我们</el-menu-item>
        </el-menu>
      </el-col>
      <el-col :span="6">
        <div class="login-status">
          <el-row>
            <el-col :span="7">
              <router-link to="/register">注册</router-link> 
               | 
              <router-link to="/login">登录</router-link></el-col>
            <el-col :span="7"><span class="gray">中</span>/EN</el-col>
            <el-col :offset="4"></el-col>
          </el-row>
          <div></div>
        </div>
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
  name: "Header",
  data() {
    return {
      activeIndex: '1'
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    }
  }
};
</script>
<style lang="scss">
.st-header{
  width: 100%;
  overflow: hidden;
  height: 80px;
  line-height: 80px;
  // background: #000000;
  background: #FFFFFF;
  // opacity: 0.8;
	position: fixed;
	top: 0;
	z-index: 10000;
  
  
  .el-menu.el-menu--horizontal{
    border-bottom: none;
  }

  .el-menu--horizontal>.el-menu-item{
    height: 78px;
    line-height: 78px;
  }
  .el-menu--horizontal>.el-menu-item.is-active{
    color: #ff7001;
  }
  .el-menu{
    background:none;
    .el-menu-item{
      font-size:20px;
      font-weight:400;
      color:rgba(51,51,51,1);
    }
  }

  .logo{
    padding-top: 19px;
  }

  // 登录状态
  .login-status{
    font-size:20px;
    font-weight:400;
    color:rgba(51,51,51,1);
    a{
      color:rgba(51,51,51,1);
    }
    .gray{
      color:rgba(153,153,153,1);
    }
  }
}
</style>