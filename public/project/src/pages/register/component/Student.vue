<template>
  <div class="form-page">
    <!-- 基本信息 -->
    <p class="title">
      <img src="/img/icon_info.png" alt="">
      基本信息
    </p>
    <comRegBase ref="regBase" />
    <comStudentReg ref="studentReg" />
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
import comStudentReg from "./StudentReg.vue";
import { apiRegisterPost } from "@/apis/api";
import { homePage } from "@/mixin/home";

export default {
  components: { comRegBase, comStudentReg },
  mixins: [homePage],
  data() {
    return {};
  },

  methods: {
    //  完成注册
    submitForm() {
      // 获取到组件中的form
      const regBase = this.$refs.regBase.$refs.ruleForm;
      const studentReg = this.$refs.studentReg.$refs.ruleForm;
      console.log(regBase.model, "regBase", studentReg);
      // 使用Promise.all去校验结果
      let params = {
        role_id: 3,
        user_name: regBase.model.name,
        mobile: regBase.model.phone,
        password: regBase.model.pwd,
        re_password: regBase.model.truePwd,
        email: regBase.model.email,
        school_name: studentReg.model.school,
        grade: studentReg.model.eduValue,
        valid_code: studentReg.model.vertifyMeg,
        identity_img: studentReg.model.imageId,
        student_card_img: studentReg.model.imageSchoolId
      };
      console.log(params, "params", studentReg.model.checked, 111);
      if(studentReg.model.checked){
        Promise.all([regBase, studentReg].map(this.getFormPromise)).then(res => {
          const validateResult = res.every(item => !!item);
          if (validateResult) {
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
        });
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