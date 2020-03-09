<template>
  <div>
    <p class="reg-success-title">注册已成功</p>
    <p class="reg-success-tologin">
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
.reg-success-title {
  font-size: 32px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 20px;
}
.reg-success-tologin {
  font-size: 16px;
  span:last-child {
    color: $orangeColor;
  }
}
</style>