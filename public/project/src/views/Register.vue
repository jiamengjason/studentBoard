<template>
  <div class="container containerBgColor register">
    <!-- 头部 -->
    <!-- <Header></Header> -->
    <router-link to="home" active-class="activeClass">
      <div class="back el-icon-arrow-left">
      </div>
    </router-link>
    <div class="registerBox">
      <div class="register_logo">
        <router-link to="home" active-class="activeClass">
          <img src="../assets/img/logo.png" alt="">
        </router-link>
      </div>
      <div class="register-type">
        <el-tabs v-model="activeName">
          <el-tab-pane label="学生" name="first">
            <!-- 学生注册  srart-->
            <regitsterS></regitsterS>
            <!-- 学生注册 start-->
          </el-tab-pane>
          <el-tab-pane label="家长" name="second">
            <!-- 家长注册  srart-->
            <regitsterP></regitsterP>
            <!-- 家长注册 start-->
          </el-tab-pane>
          <el-tab-pane label="机构" name="third">
            <!-- 机构注册  srart-->
            <regitsterI></regitsterI>
            <!-- 机构注册 start-->
          </el-tab-pane>
          <el-tab-pane label="教师" name="fourth">
            <!-- 家长注册  srart-->
            <regitsterT></regitsterT>
            <!-- 家长注册 start-->
          </el-tab-pane>
        </el-tabs>
      </div>
    </div>

    <!-- <Footer></Footer> -->
  </div>
</template>

<script>
  import Header from '../components/Header.vue'
  import Footer from '../components/Footer.vue'
  import regitsterS from '../components/regitsterS'
  import regitsterP from '../components/regitsterP'
  import regitsterI from '../components/regitsterI'
  import regitsterT from '../components/regitsterT'
  export default {
    name: 'login',
    data() {
      return {
        activeName: 'first',
        name: '',
        pwd: '',
        radio:''
      }
    },
    mounted(){
    },
    components: {
      Header,
      Footer,
      regitsterS,
      regitsterI,
      regitsterT,
      regitsterP
    },
    methods: {
    }
  }
</script>

<style lang="scss" scoped>
.register{
  padding: 0 0 50px 0;
  .back{
    margin: 60px 0 0 50px;
  }
  .register_logo{
    width: 300px;
    margin: 0px auto 30px auto;
    img{
      max-width: 100%;
    }
  }
}

.registerTagBox{
  max-width: 50%;
  margin: 20px auto;
}
</style>
