<template>
  <div class="login-warp">
    <p class="login-title">欢迎登录学汇网</p>
    <p class="login-desc">请使用您本人的账号密码登录</p>
    <div class="login-input">
      <p>
        <input type="text" placeholder="请输入手机号码/邮箱" />
      </p>
      <p>
        <input type="password" placeholder="请输入密码" />
      </p>
    </div>
    <p class="login-btn">登录</p>
    <p class="login-opa">
      <span>返回首页？</span>
      <span>去登录</span>
    </p>
  </div>
</template>
<script>
export default {};
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
  margin-top: -20px;
  margin-bottom: 90px;
}
// 登录输入
.login-input {
  margin-bottom: 80px;
  input {
    width: 400px;
    height: 70px;
    background: rgba(241, 241, 241, 1);
    border-radius: 10px;
    margin-bottom: 10px;
    outline: none;
    color: #999;
    font-size: 24px;
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
  margin: 0 auto;
  color: #fff;
  font-size: 34px;
  text-align: center;
  line-height: 80px;
}
.login-opa {
  font-size: 18px;
  span:first-child {
    color: #999;
  }
  span:last-child {
    color: $orangeColor;
  }
}
</style>