<template>

<div class="banner-nav">
    <div class="container"> 
      <el-row>
          <el-col :span="3">
            <div class="logobox">
              <img class="logo" src="../assets/img/logo1.png" alt="">
              <!-- <img class="logo" v-if="$route.name == 'home'" src="../assets/img/logo1.png" alt="">
              <img class="logo" v-if="$route.name == 'find'" src="../assets/img/logo.png" alt=""> -->
            </div>
          </el-col>
          <el-col :span="9">
            <!-- pc菜单 -->
            <div class="pcMenu">
              <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
                <el-menu-item index="1"><router-link to="home" active-class="activeClass">首页</router-link></el-menu-item>
                <el-menu-item index="2"><router-link to="find" active-class="activeClass">找一找</router-link></el-menu-item>
                <el-menu-item index="3"><router-link to="activity" active-class="activeClass">活动</router-link></el-menu-item>
                <el-menu-item index="4"><router-link to="studycircle" active-class="activeClass">留学圈</router-link></el-menu-item>
              </el-menu>
            </div>
            <div class="appMenu"  @click="drawer1 = true">
              <span class="el-icon-more"></span>
            </div>
            <!-- app菜单 -->

            <!-- 侧栏菜单 -->
            <div class="appMenuList">
                <el-drawer
                :visible.sync="drawer"
                :direction="direction"
                size="150px"
                class="headerDrawer">
                <p class="appnav"><router-link to="usercenter">我的</router-link></p>
                <p class="appnav"><router-link to="comingSoon">收藏</router-link></p>
                <!-- <p class="appnav"><router-link to="comingSoon">关注</router-link></p> -->
                <!-- <p class="appnav"><router-link to="comingSoon">历史</router-link></p> -->
                <p class="appnav"><router-link to="comingSoon">评论</router-link></p>
                <p class="appnav"><router-link to="comingSoon">登出</router-link></p>

                <p class="appnav mt-30"><router-link to="comingSoon">设置</router-link></p>
                <p class="appnav"><router-link to="comingSoon">关于</router-link></p>
                <p class="appnav"><router-link to="comingSoon">反馈</router-link></p>
                </el-drawer>
            </div>

            <div class="appMenuList">
                <el-drawer
                :visible.sync="drawer1"
                :direction="direction1"
                size="150px"
                class="headerDrawer">
                <p class="appnav"><router-link to="home">首页</router-link></p>
                <p class="appnav"><router-link to="find">找一找</router-link></p>
                <p class="appnav"><router-link to="activity">活动</router-link></p>
                <p class="appnav"><router-link to="studycircle">留学圈</router-link></p>
                </el-drawer>
            </div>
          </el-col>
          <el-col :span="8" :offset="2" class="tr">
            <!-- 搜索 -->
            <el-input placeholder="请输入内容" v-model="searchText" class="input-with-select" id="SearchBox">
              <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
          </el-col>
          <el-col :span="2" class="tr">
            <!-- 头像 -->
            <div v-if="!GLOBAL.userid" class="nologin" >
              <router-link to="login">注册</router-link>|
              <router-link to="register">登录</router-link>
            </div>

            <div v-if="GLOBAL.userid" @click="drawer = true" style="height:100px">
              <el-avatar class="mt-30" :size="30" icon="el-icon-user-solid">
              </el-avatar>
            </div>
          </el-col>
      </el-row>
    </div>
</div>
     
</template>
<script>
export default {
  name: 'home',
  mounted(){
    this.init()
  },
  data() {
    return {
      // 侧栏菜单显示状态
      drawer: false,
      drawer1: false,
      // 侧栏菜单方向，，，从右往左开
      direction:'rtl',
      direction1:'ltr',
      searchText: '',
      activeIndex: 1
    }
  },
  methods: {
    init(){
      if(this.$route.name == 'home'){
        this.activeIndex = '1'
      }else if(this.$route.name == 'find'){
        this.activeIndex = '2'
      }else if(this.$route.name == 'activity' || this.$route.name == 'activityinfo'){
        this.activeIndex = '3'
      }else if(this.$route.name == 'studycircle' || this.$route.name == 'studycircleinfo'){
        this.activeIndex = '4'
      }
    },
    handleSelect(v){
      this.activeIndex = v
    }
  }
}
</script>
<style lang="scss">
// 导航
.banner-nav{
  z-index: 10;
  width: 100%;
  height: 120px;
  .logobox{
    height: 100px;
    display: flex;
    align-items: center;
    img{
      max-width: 100%;
    }
  }
  .logo{
    display: inline-block;
    height: 40px;
  }
  .el-menu{
    background:none;
    font-size: 24px;
    color: #ffffff;
  }
  .el-menu.el-menu--horizontal{
    border-bottom: none;
    .el-menu-item{
      height: 100px;
      line-height: 100px;
      color: #ffffff;
      border: none;
      &:hover{
        background: none;
        color: #fff;
        font-weight: 600px;
        a{
          border-bottom: 2px solid #fff;
        }
      }
    }
    a{
      min-width: 50px;
      padding: 0 10px 5px 10px;
    }
    .is-active{
      border-bottom: none;
      a{
        border-bottom: 2px solid #fff;
      }
      color: #ffffff;
    }
  }
  .pcMenu{
    a{
      width: 100%;
    }
  }
  .appMenu{
      display: none
  }
  .el-input__inner{
    border: none!important;
    border-bottom: 1px solid #fff!important;
    background: none!important;
    border-radius: 0;
    color: #fff;
  }
  .input-with-select{
    margin-top: 25px;
    .el-input-group__append{
      background: none;
      border: none;
      padding: 10px;
      
      .el-button{
        font-size: 20px;
        color: #fff;
        font-weight: bold;
      }
    }
  }
}
.nologin{
  line-height: 120px;
  color: #fff;
  a{
    &:first-child{
      padding-right: 5px;
    }
    color: #fff;
    font-size: 14px;
  }
}

// 右侧展开导航
.headerDrawer{
  .el-drawer{
    background: rgba($color: #fff, $alpha: 0.9);
  }
  .appnav{
    padding: 0 0 0 30px;
    color: #333;
    line-height: 35px;
    font-size: 14px;
    a{
      color: #333;
    }
  }
}

@media screen and (max-width: 750px) {
  .banner-nav{
    .pcMenu{
      display: none;
    }
    .appMenu{
      display: block;
      color: #fff;
      font-size: 26px;
      margin: 30px 0  0 30px;
    }
  }
}
</style>