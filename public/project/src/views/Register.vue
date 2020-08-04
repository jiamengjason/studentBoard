<template>
  <div class="container containerBgColor">
    <!-- 头部 -->
    <!-- <Header></Header> -->
    <router-link to="home" active-class="activeClass">
      <div class="back el-icon-arrow-left">
      </div>
    </router-link>
    <div class="register">
      <div class="login_logo">
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
          <el-tab-pane label="家长" name="second">家长</el-tab-pane>
          <el-tab-pane label="机构" name="third">机构</el-tab-pane>
          <el-tab-pane label="教师" name="fourth">教师</el-tab-pane>
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
      regitsterS
    },
    methods: {
    }
  }
</script>

<style lang="scss" scoped>

</style>
