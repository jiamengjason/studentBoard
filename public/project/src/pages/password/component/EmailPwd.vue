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
import { apiResetPwByEmail } from "@/apis/api";
import { homePage } from "@/mixin/home";

export default {
  name: "RegBase",
  mixins: [homePage],
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
      apiResetPwByEmail({email:this.ruleForm.email}).then(res => {
          if(res.data.code == 200){
            this.successPath = 2 // 2代表是修改成功
            this.$message.success("修改成功");
            this.toRegisterSuccessPageFn()
          }else{
            this.$message.error(res.data.msg);
          }
        });
      } else {
        this.$message.error("请输入邮箱");
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