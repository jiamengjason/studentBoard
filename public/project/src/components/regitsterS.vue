<template>
  <div class="registerTagBox">
    <div class="container">
      <el-form v-if="!isSuccess" ref="ruleForm" :model="ruleForm" :rules="rules" label-width="100px">
        <el-form-item label="用户名" required prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
        <el-form-item label="手机号" required prop="phone">
          <el-input v-model="ruleForm.phone"></el-input>
        </el-form-item>
        <el-form-item label="密码" required prop="pwd">
          <el-input v-model="ruleForm.pwd" type="password"></el-input>
        </el-form-item>
        <el-form-item label="确认密码" required prop="truePwd">
          <el-input v-model="ruleForm.truePwd" type="password"></el-input>
        </el-form-item>
        <el-form-item label="邮箱" required prop="email">
          <el-input v-model="ruleForm.email"></el-input>
        </el-form-item>
        <el-form-item label="手机验证码" required prop="vertifyMeg">
          <el-input style="width:358px;margin-right:10px" v-model="ruleForm.vertifyMeg" class="vertify-code"></el-input>
          <el-button plain :disabled="clickCodeFlag" @click="getVertifyCode">{{ codeText }}</el-button>
        </el-form-item>
        <el-form-item>
          <el-checkbox v-model="ruleForm.checked" class="check-agree">本人已阅并同意本站注册的要求内容</el-checkbox>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit" round>立即注册</el-button>
        </el-form-item>
      </el-form>


      <!-- 完成 -->
      <p class="reg-submit-warp" v-if="isSuccess">
        <el-button type="primary" @click="goLogin">完成注册</el-button>
        <span style="margin-left: 20px;">已有账号？</span>
        <router-link to="login">去登录</router-link>
      </p>
    </div>
  </div>

</template>
<script>
import { checkPhone } from "../base"
import { apiGetValidCodePost,apiRegisterPost } from "../api";
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
          if (value === this.ruleForm.pwd) {
            callback();
          } else {
            callback(new Error("两次输入的密码不一致"));
          }
        }, 100);
      };
      return {
        isSuccess: false,
        ruleForm: {
          name: "",
          pwd: "",
          truePwd: "",
          email: "",
          phone: ""
        },
        clickCodeFlag: false,
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
          phone: [{ required: true, validator: checkPhone, trigger: "blur" }],
          vertifyMeg: [{ required: true, message: "请输入验证码", trigger: "blur" }]
        }
      }
    },
    computed: {
      codeText() {
        if (this.clickCodeFlag) {
          return `${this.timerNum}s后失效`;
        }
        return "获取验证码";
      }
    },
    methods: {
      onSubmit() {
        this.$refs['ruleForm'].validate((valid) => {
          if (valid) {
            let params = {
              role_id: 3,
              user_name: this.ruleForm.name,
              mobile: this.ruleForm.phone,
              password: this.ruleForm.pwd,
              re_password: this.ruleForm.truePwd,
              email: this.ruleForm.email,
              school_name: this.ruleForm.school,
              grade: this.ruleForm.eduValue,
              valid_code: this.ruleForm.vertifyMeg,
              // identity_img: this.ruleForm.imageId,
              // student_card_img: this.ruleForm.imageSchoolId
            }
            apiRegisterPost(params).then(res => {
              if(res.data.code == 200){
                this.$message.success("注册成功");
                this.isSuccess = true
              }else{
                this.$message.error(res.data.msg);
              }
            });
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      updatePhone(e) {
        this.setMobile(e);
      },
      // 获取验证码
      getVertifyCode() {
        if (this.ruleForm.phone) {
          apiGetValidCodePost({ mobile: this.ruleForm.phone }).then(res => {
            if (res.data.code == 200) {
              this.$message.success('发送验证码成功')
              this.clickCodeFlag = true;
              this.timer = setInterval(this.cutDown, 1000);
            }else{
              this.$message.error(res.data.msg);
            }
          });
        }
      },
      goLogin(){
        this.$router.push({path:'login'})
      }
    }
  }
</script>
<style lang="scss" scoped>
.reg-submit-warp{
  min-height: 300px;
  padding-top: 50px;
  text-align: center;
}
</style>