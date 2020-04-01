<template>
  <div class="st-header">
    <el-row :gutter="20">
      <el-col :span="7" class="logo">
        <img src="/logo.png" alt="">
      </el-col>
      <el-col :span="11">
        <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
          <el-menu-item index="1">
            <router-link :to="{name: 'home'}">首页</router-link>
          </el-menu-item>
          <el-menu-item index="2">
            <router-link :to="{name: 'organization'}">著名机构</router-link>
          </el-menu-item>
          <el-menu-item index="3">
            <router-link :to="{name: 'teachers'}">知名教师</router-link>
          </el-menu-item>
          <el-menu-item index="4">
            <router-link :to="{name: 'activity'}">课外活动</router-link>
          </el-menu-item>
          <el-menu-item index="5">
            <router-link :to="{name: 'studyCircle'}">留学圈</router-link>
          </el-menu-item>
          <el-menu-item index="6">
            <router-link :to="{name: 'aboutUs'}">关于我们</router-link>
          </el-menu-item>
        </el-menu>
      </el-col>
      <el-col :span="6">
        <div class="login-status">
          <el-row>
            <el-col :span="7">
              <router-link to="/register">注册</router-link>
              |
              <router-link to="/login">登录</router-link>
            </el-col>
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
  mounted(){
    this.getCurrtActive()
  },
  methods: {
    getCurrtActive(){
      console.info('this.route', this.$route)
      // 著名机构
      if(this.$route.name == 'organization' || this.$route.name == 'organizationinfo'){
        this.activeIndex = '2'
      }else if(this.$route.name == 'teachers' || this.$route.name == 'teachersinfo'){
        // 知名教师
        this.activeIndex = '3'
      }else if(this.$route.name == 'activity' || this.$route.name == 'activityinfo'){
        // 课外活动
        this.activeIndex = '4'
      }else if(this.$route.name == 'studyCircle'){
        // 留学圈
        this.activeIndex = '5'
      }else if(this.$route.name == 'aboutUs'){
        // 关于我们
        this.activeIndex = '6'
      }
    },
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
  box-shadow:0px 1px 5px 0px rgba(4,0,0,0.2);
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
    border-bottom: 2px solid #ff7001;
  }
  .el-menu{
    background:none;
    .el-menu-item{
      font-size:20px;
      font-weight:400;
      color:rgba(51,51,51,1);
      a{
        display: inline-block;
      }
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