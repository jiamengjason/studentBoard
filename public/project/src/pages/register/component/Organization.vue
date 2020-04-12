<template>
  <div class="form-page">
    <!-- 基本信息 -->
    <p class="title">
      <img src="/img/icon_info.png" alt="">
      基本信息
    </p>
    <comOrgBase ref="orgBase" />
    <p class="title">负责人信息</p>
    <comRegBase ref="regBase" />
    <comOrgReg ref="orgReg" />
    <!-- 完成 -->
    <p class="reg-submit-warp">
      <el-button type="primary" @click="submitForm">完成注册</el-button>
      <span style="margin-left: 20px;">已有账号？</span>
      <span @click="toLoginPageFn">去登录</span>
    </p>
  </div>
</template>
<script>
import comRegBase from "./RegBase.vue";
import comOrgReg from "./OrgReg.vue";
import comOrgBase from "./OrgBase.vue";
import { apiRegisterPost } from "@/apis/api";
import { homePage } from "@/mixin/home";

export default {
  components: { comRegBase, comOrgReg, comOrgBase },
  mixins: [homePage],
  data() {
    return {};
  },
  methods: {
    //  完成注册
    submitForm() {
      // 获取到组件中的form
      const regBase = this.$refs.regBase.$refs.ruleForm;
      const orgReg = this.$refs.orgReg.$refs.ruleForm;
      const orgBase = this.$refs.orgBase.$refs.ruleForm;
      console.log(regBase.model, "regBase", orgReg);
      let params = {
        role_id: 1,
        organization_name: orgBase.model.name,
        organization_email: orgBase.model.email,
        organization_desc: orgBase.model.orgIntro,
        user_name: regBase.model.name,
        mobile: regBase.model.phone,
        password: regBase.model.pwd,
        re_password: regBase.model.truePwd,
        email: regBase.model.email,
        valid_code: orgReg.model.vertifyMeg,
        identity_img: orgReg.model.imageId
      };
      console.log(params, "params");
      // 使用Promise.all去校验结果
      if(orgReg.model.checked){
        Promise.all([orgBase, regBase, orgReg].map(this.getFormPromise)).then(
          res => {
            const validateResult = res.every(item => !!item);
            if (validateResult) {
              console.log("三个表单都校验通过");
              apiRegisterPost(params).then(res => {
              if(res.data.code == 200){
                this.$message.success("注册成功");
                this.toRegisterSuccessPageFn()
              }else{
                this.$message.error(res.data.msg);
              }
            });
            } else {
              this.$message.error("注册信息不完整");

            }
          }
        );
      }
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