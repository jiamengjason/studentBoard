<template>
  <el-form
    ref="ruleForm"
    :model="ruleForm"
    status-icon
    :rules="rules"
    label-width="100px"
    class="demo-ruleForm"
  >
    <!-- 手机号 -->
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="手机号码：" prop="mobile">
          <el-input v-model="ruleForm.mobile"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="验证码：" prop="vertifyMeg">
          <el-input v-model="ruleForm.vertifyMeg" class="vertify-code-pwd"></el-input>
          <el-button plain :disabled="clickCodeFlag" @click="getVertifyCode">{{ codeText }}</el-button>
        </el-form-item>
      </el-col>
    </el-row>
    <!-- 密码 -->
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="新密码：" prop="newPwd">
          <el-input v-model="ruleForm.newPwd"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="确认密码：" prop="vertifyMeg">
          <el-input v-model="ruleForm.verNewPwd"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <p class="be-sure">确认</p>
  </el-form>
</template>
<script>
export default {
  name: "RegBase",
  data() {
    return {
      ruleForm: {
        mobile: "",
        vertifyMeg: "",
        newPwd: "",
        verNewPwd: ""
      },
      clickCodeFlag: false,
      timerNum: 5,
      timer: null,
      rules: {
        mobile: [{ required: true, message: "请输入手机号", trigger: "blur" }],
        vertifyMeg: [{ required: true, message: "请输入验证码", trigger: "blur" }],
        newPwd:[{ required: true, message: "请输入新密码", trigger: "blur" }]

      }
    };
  },
  computed: {
    codeText() {
      if (this.clickCodeFlag) {
        return `${this.num}s后失效`;
      }
      return "获取验证码";
    }
  },
  watch: {},
  mounted() {},
  methods: {
    // 获取验证码
    getVertifyCode() {
      if (this.mobile) {
        this.clickCodeFlag = true;
        this.timer = setInterval(this.cutDown, 1000);
      }
    },
    cutDown() {
      this.timerNum--;
      if (this.timerNum <= 0) {
        this.timerNum = 0;
        this.clickCodeFlag = false;
        clearInterval(this.timer);
      }
    }
  }
};
</script>
<style lang="scss" scoped>
@import "../../register/component/ele-reset.css";
.demo-ruleForm {
  padding: 0 60px;
  margin-top: 60px;
}
.vertify-code-pwd{
  width: 124px;
  margin-right: 20px;
  margin-left:-40px;
}
.be-sure {
  cursor: pointer;
  width: 300px;
  height: 60px;
  background: rgba(255, 112, 1, 1);
  border-radius: 10px;
  font-size: 28px;
  text-align: center;
  line-height: 60px;
  color: #fff;
  margin: 110px auto 0;
}
</style>