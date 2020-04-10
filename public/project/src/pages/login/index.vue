<template>
  <div class="login-warp">
    <p class="login-title">欢迎登录学汇网</p>
    <p class="login-desc">请使用您本人的账号密码登录</p>
    <div class="login-input">
      <p>
        <input v-model="loginInput" type="text" placeholder="请输入手机号码/邮箱" />
      </p>
      <p>
        <input v-model="loginPwd" type="password" placeholder="请输入密码" />
      </p>
    </div>
    <p class="login-btn" @click="toLoginFn">登录</p>
    <p class="login-opa">
      <span @click="toPwdPageFn">忘记密码？</span>
      <span @click="toRegPageFn">去注册账号</span>
    </p>
  </div>
</template>
<script>
import { homePage } from "@/mixin/home";
import { apiLoginDoPost } from "@/apis/api";
export default {
  mixins: [homePage],

  data() {
    return {
      loginInput: "",
      loginPwd: ""
    };
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
            localStorage.setItem('board_token', res.data.data.token)
            localStorage.setItem('board_user_id', res.data.data.user_id)
            localStorage.setItem('board_role_id', res.data.data.role_id)
            this.toHomePageFn()
          }else{
            this.$message.error(res.data.msg);
          }
        });
      }else{
        this.$message.error('请输入手机号/邮箱或者密码');

      }
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.login-warp {
  width: 640px;
  height: 698px;
  margin: 160px auto 0;
  background: #fff;
  border: 1px solid red;
  padding-top: 32px;
  text-align: center;
}
.login-title {
  color: $orangeColor;
  font-size: 40px;
}
.login-desc {
  font-size: 26px;
  color: #999;
  margin-bottom: 90px;
}
// 登录输入
.login-input {
  margin-bottom: 80px;
  input {
    width: 400px;
    height: 70px;
    background: #f1f1f1;
    border-radius: 10px;
    margin-bottom: 10px;
    outline: none;
    color: #999;
    font-size: 22px;
    border: none;
    padding: 0 30px;
  }
}
.login-btn {
  width: 463px;
  height: 80px;
  background: $orangeColor;
  box-shadow: 0px 4px 15px 0px rgba(255, 112, 1, 0.4);
  border-radius: 40px;
  margin: 0 auto 20px;
  color: #fff;
  font-size: 34px;
  text-align: center;
  line-height: 80px;
  cursor: pointer;
}
.login-opa {
  font-size: 18px;
  cursor: pointer;
  span:first-child {
    color: #999;
  }
  span:last-child {
    color: $orangeColor;
  }
}
</style>