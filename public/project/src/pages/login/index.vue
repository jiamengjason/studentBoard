<template>
  <div class="login-warp">
    <p class="login-title">欢迎登录学汇网</p>
    <p class="login-desc">请使用您本人的账号密码登录</p>
  </div>
</template>
<script>
export default {};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.login-warp {
  width: 640px;
  height: 638px;
  margin: 160px auto 0;
  background: #fff;
  border: 1px solid red;
  padding-top: 92px;
  text-align: center;
}
.login-title {
  color: $orangeColor;
  font-size: 40px;
}
.login-desc {
  font-size: 26px;
  color: #999;
  margin-bottom: 80px;
}
</style>