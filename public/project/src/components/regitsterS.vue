<template>
  <div class="registerTagBox">
    <div class="container">
      <el-form ref="ruleForm" :model="ruleForm" :rules="rules" label-width="100px">
        <el-form-item label="用户名" required>
          <el-input v-model="ruleForm.name" prop="name"></el-input>
        </el-form-item>
        <el-form-item label="手机号" required>
          <el-input v-model="ruleForm.phone" prop="phone"></el-input>
        </el-form-item>
        <el-form-item label="密码" required prop="pwd">
          <el-input v-model="ruleForm.pwd"></el-input>
        </el-form-item>
        <el-form-item label="确认密码" required prop="truePwd">
          <el-input v-model="ruleForm.truePwd"></el-input>
        </el-form-item>
        <el-form-item label="邮箱" required prop="email">
          <el-input v-model="ruleForm.email"></el-input>
        </el-form-item>
        <el-form-item label="手机验证码" required>
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
        <el-form-item>
          <el-checkbox v-model="ruleForm.checked" class="check-agree">本人已阅并同意本站注册的要求内容</el-checkbox>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit" round>立即注册</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>

</template>
<script>
import { checkPhone } from "../base"
  export default {
    name: 'registerS',
    mounted(){
    },
    data() {
      // 确认密码验证
      let checkPwd = (rule, value, callback) => {
        if (!value) {
          return callback(new Error("请确认您的密码"));
        }
        setTimeout(() => {
          if (value === this.form.pwd) {
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
      }
    },
    methods: {
      onSubmit() {
        this.$refs['ruleForm'].validate((valid) => {
          if (valid) {
            alert('submit!');
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      updatePhone(e) {
        this.setMobile(e);
      }
    }
  }
</script>
<style lang="scss">

</style>