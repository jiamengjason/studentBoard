<template>
  <div>
    <p class="reg-success-title">修改已成功</p>
    <p class="reg-success-tologin">
      <span @click="toHomePageFn">返回首页？</span>
      <span @click="toLoginPageFn">去登录</span>
    </p>
  </div>
</template>
<script>
import { homePage } from "@/mixin/home";

export default {
  mixins: [homePage]
};
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