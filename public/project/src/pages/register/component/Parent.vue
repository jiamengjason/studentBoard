<template>
  <div class="form-page">
    <!-- 基本信息 -->
    <p class="title">基本信息</p>
    <comRegBase ref="regBase" />
    <comParentReg ref="parentReg" />
    <!-- 完成 -->
    <p class="reg-submit-warp">
      <el-button type="primary" @click="submitForm">完成注册</el-button>
      <span style="margin-left: 20px;">已有账号？</span>
      <span>去登录</span>
    </p>
  </div>
</template>
<script>
import comRegBase from "./RegBase.vue";
import comParentReg from "./ParentReg.vue";
import { apiRegisterPost } from "@/apis/api";

export default {
  components: { comRegBase, comParentReg },
  data() {
    return {};
  },

  methods: {
    //  完成注册
    submitForm() {
      // 获取到组件中的form
      const regBase = this.$refs.regBase.$refs.ruleForm;
      const parentReg = this.$refs.parentReg.$refs.ruleForm;
      console.log(regBase.model, "regBase", parentReg);
      let params = {
        role_id: 1,
        user_name: regBase.model.name,
        mobile: regBase.model.phone,
        password: regBase.model.pwd,
        re_password: regBase.model.truePwd,
        email: regBase.model.email,
        valid_code: parentReg.model.vertifyMeg,
        identity_img: parentReg.model.imageId
      };
      console.log(params, "params");
      // 使用Promise.all去校验结果
      Promise.all([regBase, parentReg].map(this.getFormPromise)).then(res => {
        const validateResult = res.every(item => !!item);
        if (validateResult) {
          console.log("两个表单都校验通过");
          apiRegisterPost(params).then(res => {
            consoel.log(1111, res);
          });
        } else {
          console.log("两个表单未校验通过");
        }
      });
    },
    getFormPromise(form) {
      return new Promise(resolve => {
        form.validate(res => {
          resolve(res);
        });
      });
    }
  }
};
</script>
<style lang="scss" scoped>
@import "./ele-reset.css";
@import "./base.scss";
</style>