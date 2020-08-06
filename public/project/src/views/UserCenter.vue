<template>
  <div class="bg2">
    <!-- 头部 -->
    <Header></Header>
    <div class="container containerBgColor1 usercenter">
        <div class="personal-top-com">
            <div class="top-img">
                <el-row>
                    <el-col :span="4">
                        <div class="top-head-img">
                            <el-avatar :size="120" icon="el-icon-user-solid"></el-avatar>
                        </div>
                    </el-col>
                    <el-col :span="20">
                        <p class="top-name">用户名XXXXX</p>
                        <p class="top-mobile">XXXXX@XXXXX</p>
                        <el-button type="warning" icon="el-icon-plus" circle class="addWord" title="发布文章"></el-button>
                    </el-col>
                </el-row>
            </div>
        </div>

        <div class="usercenter-tagcon">
            <el-tabs type="card" v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="个人中心" name="first">
                    <UserInfo></UserInfo>
                </el-tab-pane>
                <el-tab-pane label="参加活动" name="second">参加活动</el-tab-pane>
                <el-tab-pane label="我的评价" name="third">我的评价</el-tab-pane>
                <el-tab-pane label="我的文章" name="four">我的文章</el-tab-pane>
            </el-tabs>
        </div>
        
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
</template>

<script>
  import Header from '../components/Header.vue'
  import Footer from '../components/Footer.vue'
  import UserInfo from '../components/user_info.vue'
  export default {
    name: 'usercenter',
    data() {
      return {
        activeName: 'first',
        name: '',
        pwd: '',
        radio:'',
        userInfo: {}
      }
    },
    mounted(){
    },
    components: {
      Header,
      Footer,
      UserInfo
    },
    methods: {
    }
  }
</script>

<style lang="scss" scoped>
// 顶部样式
.personal-top-com {
  width: 100%;
  .top-img {
    width: 100%;
    .top-head-img {
      display: block;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 30px auto 30px auto;
      .el-avatar--icon{
        font-size: 70px;
      }
    }
    .top-name {
      margin-top: 60px;
      font-size: 28px;
      color: rgba(51, 51, 51, 1);
    }
    .top-mobile {
      margin-top: 6px;
      font-size: 22px;
      color: rgba(102, 102, 102, 1);
    }
    .addWord{
        position: absolute;
        right: 50px;
        top: 50px;
    }
  }
}

.usercenter-tagcon{
    padding: 0 50px 50px 50px;
    .el-tabs__nav-wrap::after{
        background-color: #999;;
    }
}
</style>
