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
            placeholder="请输入手机号码/邮箱"
            prefix-icon="el-icon-user-solid"
            v-model="loginInput"
            type="text">
          </el-input>
          <el-input
            type="password"
            class="userpwd"
            placeholder="请输入密码"
            prefix-icon="el-icon-lock"
            v-model="loginPwd">
          </el-input>
          <p class="wjmm">
            <el-radio v-model="radio" label="1">记住密码</el-radio>
            <span style="float:right; color:#666666;">忘记密码</span>
          </p>
          <p class="loginbtn">
            <el-button type="primary" round @click="toLoginFn">
              登录
            </el-button>
          </p>
          <p class="registbtn">
            <router-link to="identity" active-class="activeClass">
              <el-button round>注册</el-button>
            </router-link>
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
import {apiLoginDoPost} from '../api'
export default {
  name: 'login',
  data() {
    return {
      loginInput: '',
      loginPwd: '',
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
    toLoginFn() {
      if (this.loginInput && this.loginPwd) {
        let params = {
          mobile: this.loginInput,
          password: this.loginPwd
        };
        apiLoginDoPost(params).then(res => {
         if(res.data.code == 200){
            this.$message.success("登录成功");
            this.$cookies.set('token', res.data.data.token) 
            this.$cookies.set('userId', res.data.data.user_id) 
            this.$cookies.set('roleId', res.data.data.role_id) 
            this.$router.push({name: 'index'})
            this.$router.go(0)
          }else{
            this.$message.error(res.data.msg);
          }
        });
      }else{
        this.$message.error('请输入手机号/邮箱或者密码');
      }
    }
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
