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
        <el-form-item label="Email：" prop="email">
          <el-input v-model="ruleForm.email"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <p class="be-sure" @click="sendEmail">确认</p>
  </el-form>
</template>
<script>
export default {
  name: "RegBase",
  data() {
    return {
      ruleForm: {
        email: ""
      },
      rules: {
        email: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ],
      }
    };
  },
  computed: {},
  watch: {},
  mounted() {},
  methods: {
    // 发送邮箱
    sendEmail() {
      if (this.email) {
        console.log(this.email);
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