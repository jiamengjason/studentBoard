<template>

<div class="banner-nav">
    <div class="container"> 
      <el-row>
          <el-col :span="6">
            <img class="logo" src="../assets/img/logo1.png" alt="">
          </el-col>
          <el-col :span="7">
            <!-- pc菜单 -->
            <div class="pcMenu">
              <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
              <el-menu-item index="1"><router-link to="comingSoon" active-class="activeClass">首页</router-link></el-menu-item>
              <el-menu-item index="2"><router-link to="comingSoon" active-class="activeClass">找一找</router-link></el-menu-item>
              <el-menu-item index="3"><router-link to="comingSoon" active-class="activeClass">活动</router-link></el-menu-item>
              <el-menu-item index="4"><router-link to="comingSoon" active-class="activeClass">留学圈</router-link></el-menu-item>
              </el-menu>
            </div>
            <!-- app菜单 -->
            <div class="appMenu el-icon-more" icon="el-icon-more" @click="drawer = true">&nbsp;</div>

            <!-- 侧栏菜单 -->
            <div class="appMenuList">
                <el-drawer
                :visible.sync="drawer"
                :direction="direction"
                size="150px"
                class="headerDrawer">
                <p class="appnav"><router-link to="comingSoon">我的</router-link></p>
                <p class="appnav"><router-link to="comingSoon">收藏</router-link></p>
                <p class="appnav"><router-link to="comingSoon">关注</router-link></p>
                <p class="appnav"><router-link to="comingSoon">历史</router-link></p>
                <p class="appnav"><router-link to="comingSoon">评论</router-link></p>
                <p class="appnav"><router-link to="comingSoon">登出</router-link></p>

                <p class="appnav"><router-link to="comingSoon">设置</router-link></p>
                <p class="appnav"><router-link to="comingSoon">关于</router-link></p>
                <p class="appnav"><router-link to="comingSoon">反馈</router-link></p>
                </el-drawer>
            </div>
          </el-col>
          <el-col :span="7">
            <!-- 搜索 -->
            <el-input placeholder="请输入内容" v-model="searchText" class="input-with-select mt-30">
              <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
          </el-col>
          <el-col :span="4" class="tr">
            <!-- 头像 -->
            <div @click="drawer = true">
              <el-avatar class="mt-30" :size="40" icon="el-icon-user-solid">
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
  props: {
    activeIndex: String
  },
  data() {
    return {
      // 侧栏菜单显示状态
      drawer: false,
      // 侧栏菜单方向，，，从右往左开
      direction:'rtl',
      searchText: ''
    }
  },
  methods: {
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
  height: 100px;
  .logo{
    // width: 78px;
    height: 72px;
    margin-top: 14px;
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
    }
    .is-active{
      background: #ee6b03;
      border-bottom: none;
      color: #ffffff;
    }
  }
  .pcMenu{
    a{
      display: inline-block;
      width: 100%;
      height: 100%;
    }
  }
  .appMenu{
      display: none
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
    line-height: 30px;
    font-size: 14px;
    a{
      color: #333;
    }
  }
}
</style>