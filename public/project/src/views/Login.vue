<template>
  <div class="login container containerBgColor">
    <!-- 头部 -->
    <!-- <Header></Header> -->
    <router-link to="home" active-class="activeClass">
      <div class="back el-icon-arrow-left">
      </div>
    </router-link>
    <div class="loginbox">
      <el-row :gutter="20">
        <el-col :span="8" :offset="8">
          <div class="login_logo">
            <router-link to="home" active-class="activeClass">
              <img src="../assets/img/logo.png" alt="">
            </router-link>
          </div>
          <el-input
            class="userinput"
            placeholder="账号"
            prefix-icon="el-icon-user-solid"
            v-model="name">
          </el-input>
          <el-input
            class="userpwd"
            placeholder="密码"
            prefix-icon="el-icon-lock"
            v-model="pwd">
          </el-input>
          <p class="wjmm">
            <el-radio v-model="radio" label="1">记住密码</el-radio>
            <span style="float:right; color:#666666;">忘记密码</span>
          </p>
          <p class="loginbtn">
            <el-button type="primary" round>登录</el-button>
          </p>
          <p class="registbtn">
            <el-button round>注册</el-button>
          </p>
        </el-col>
      </el-row>
    </div>
    <!-- <Footer></Footer> -->
  </div>
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
export default {
  name: 'login',
  data() {
    return {
      name: '',
      pwd: '',
      radio:''
    }
  },
  mounted(){
  },
  components: {
    Header,
    Footer
  },
  methods: {
  }
}
</script>

<style lang="scss" scoped>
.login{
  min-height: 100%;
  .back{
    margin: 60px 0 0 50px;
  }
}
.loginbox{
  height: 500px;
  width: 100%;
  position: absolute;
  left: 0;
  top: 50%;
  margin-top: -280px;
}
.login_logo{
  max-width: 200px;
  margin: 50px auto 40px auto;
  img{
    max-width: 100%;
  }
}
.userinput{
  margin:30px 0;
}
.userpwd{
  margin-bottom: 10px;
}
.wjmm{
  margin-bottom: 20px;
}
.loginbtn,.registbtn{
  width: 50%;
  margin: 0 auto;
  .el-button{
    width: 100%;
  }
}
.loginbtn{
  margin-bottom: 15px;;
}
</style>
