<template>
  <div class="page-warp">
    <Hearder />
    <comBreadcrumb class="bread-crumb" :bread-list="breadList" />
    <div class="password-page">
      <el-tabs v-model="activeName" :stretch="stretch" @tab-click="handleClick">
        <el-tab-pane
          v-for="(item,index) in navList"
          :key="index"
          :label="item.name"
          :name="item.key"
        >
          {{ item }}
        </el-tab-pane>
      </el-tabs>
      <comMobile :pwd-type="pwdType" />
    </div>
    <Footer />
  </div>
</template>
<script>
import Hearder from "@/components/Hearder";
import Footer from "@/components/Footer";
import comBreadcrumb from "@/components/Breadcrumb";
import comMobile from "./component/MobilePwd";

export default {
  components: {
    Hearder,
    Footer,
    comBreadcrumb,
    comMobile
  },
  data() {
    return {
      activeName: "mobile",
      stretch: true,
      navList: [
        { name: "手机验证", key: "mobile" },
        { name: "邮箱验证", key: "email" }
      ]
    };
  },
  computed: {
    breadList(){
      if(this.activeName == 'mobile'){
      return ['忘记密码','手机验证']
      }
      return ['忘记密码','邮箱验证']
    },
    pwdType(){
      if(this.activeName == 'mobile'){
      return 'mobile'
      }
      return 'email'
    }
  },
  methods: {
    handleClick(tab) {
      this.activeName = tab.name;
    }
  }
};
</script>
<style lang="scss" scoped>
.page-warp {
  background: #f5f5f5;
}
.password-page {
  width: 1400px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 140px;
  padding: 30px 0 110px;
}
.bread-crumb{
  margin:80px auto 0;
}
.tab-warp {
  .grid-content {
    font-size: 22px;
    font-weight: 600;
  }
}
.tab-item {
  padding-bottom: 30px;
  border-bottom: 1px solid #ccc;
}


</style>