<template>
  <div class="page-warp">
    <Hearder />
    <Breadcrumb class="bread-crumb" :bread-list="breadList" />
    <div class="register-page">
      <img src="/img/icon_success.png" class="register-success-icon" />  
      <p class="reg-success-title">{{ text }}已成功</p>
      <p class="reg-success-tologin">
        <span>返回首页？</span>
        <span @click="toLoginPageFn">去登录</span>
      </p>
    </div>
    <Footer />
  </div>
</template>
<script>
import { homePage } from "@/mixin/home";
import Hearder from "@/components/Hearder";
import Footer from "@/components/Footer";
import Breadcrumb from "@/components/Breadcrumb";

export default {
  components: {
    Hearder,
    Footer,
    Breadcrumb
  },
  mixins: [homePage],
  data(){
    return {}
  },
  computed: {
    text(){
      if(this.$route.query.id === 2){
        return "修改"
      }
      return "注册"
    },
    breadList(){
      if(this.$route.query.id === 2){
        return ['忘记密码']
      }
      return ['个人注册']
    }
  },
  created() {
    console.log(this.$route.query.id)
  },
};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";
.bread-crumb{
  margin-top:80px;
}
.register-page {
  width: 1400px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 140px;
  padding: 110px 0;
}
.reg-success-title {
  font-size: 32px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 20px;
}
.reg-success-tologin {
  cursor: pointer;
  font-size: 16px;
  span:last-child {
    color: $orangeColor;
  }
}
.register-success-icon{
  width: 110px;
  height: 110px;
}
</style>