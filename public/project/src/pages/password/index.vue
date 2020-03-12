<template>
  <div class="page-warp">
    <comBreadcrumb />
    <div class="register-page">
      <el-tabs v-model="activeName" :stretch="stretch" @tab-click="handleClick">
        <el-tab-pane
          v-for="(item,index) in navList"
          :key="index"
          :label="item.name"
          :name="item.key"
        >{{ item }}</el-tab-pane>
      </el-tabs>
      <comMobile v-if="activeName == 'mobile'" />
      <comEmail v-if="activeName == 'email'" />
    </div>
  </div>
</template>
<script>
import comBreadcrumb from "@/components/Breadcrumb";
import comMobile from "./component/MobilePwd";
import comEmail from "./component/EmailPwd";

export default {
  components: {
    comBreadcrumb,
    comMobile,
    comEmail
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
  methods: {
    handleClick(tab) {
      console.log(tab.name, tab);
      this.activeName = tab.name;
    }
  }
};
</script>
<style lang="scss">
.page-warp {
  background: #f5f5f5;
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
.register-page {
  width: 1400px;
  height: 1000px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 0;
  padding-top: 30px;
}
</style>