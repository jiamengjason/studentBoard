<template>
  <el-form
    ref="ruleForm"
    :model="ruleForm"
    status-icon
    :rules="rules"
    label-width="100px"
    class="demo-ruleForm"
  >
    <!-- 姓名 -->
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="用户名：" prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="手机号码：" prop="phone">
          <el-input v-model="ruleForm.phone" @input="updatePhone"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <!-- 密码 -->
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="设置密码：" prop="pwd">
          <el-input v-model="ruleForm.pwd" show-password></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="确认密码：" prop="truePwd">
          <el-input v-model="ruleForm.truePwd" show-password></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <!-- email -->
    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="Email：" prop="email">
          <el-input v-model="ruleForm.email"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
</template>
<script>
import { mapMutations } from "vuex";
export default {
  name: "RegBase",
  data() {
    // 手机号验证
    let checkPhone = (rule, value, callback) => {
      const phoneReg = /^1[3|4|5|6|7|8][0-9]{9}$/;
      if (!value) {
        return callback(new Error("手机号码不能为空"));
      }
      setTimeout(() => {
        if (!Number.isInteger(+value)) {
          callback(new Error("请输入数字值"));
        } else {
          if (phoneReg.test(value)) {
            callback();
          } else {
            callback(new Error("手机号码格式不正确"));
          }
        }
      }, 100);
    };
    // 确认密码验证
    let checkPwd = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("请确认您的密码"));
      }
      setTimeout(() => {
        if (value === this.ruleForm.pwd) {
          callback();
        } else {
          callback(new Error("两次输入的密码不一致"));
        }
      }, 100);
    };
    return {
      ruleForm: {
        name: "",
        pwd: "",
        truePwd: "",
        email: "",
        phone: ""
      },
      rules: {
        name: [{ required: true, message: "请输入用户名", trigger: "blur" }],
        pwd: [
          { required: true, message: "请输入密码", trigger: "blur" },
          { min: 6, max: 18, message: "长度在6到18个字符", trigger: "blur" }
        ],
        truePwd: [{ required: true, validator: checkPwd, trigger: "blur" }],
        email: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ],
        phone: [{ required: true, validator: checkPhone, trigger: "blur" }]
      }
    };
  },
  computed: {},
  watch: {},
  mounted() {},
  methods: {
    ...mapMutations(["setMobile"]),
    updatePhone(e) {
      this.setMobile(e);
    }
  }
};
</script>
<style lang="scss" scoped>
</style>