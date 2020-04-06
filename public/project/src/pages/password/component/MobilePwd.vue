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
      <el-col v-if="pwdType === 'mobile'" :span="8">
        <el-form-item label="手机号码：" prop="mobile">
          <el-input v-model="ruleForm.mobile"></el-input>
        </el-form-item>
      </el-col>
      <el-col v-else :span="8">
        <el-form-item label="Email：" prop="email">
          <el-input v-model="ruleForm.email"></el-input>
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
          <el-input v-model="ruleForm.newPwd" show-password></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="确认密码：" prop="verNewPwd">
          <el-input v-model="ruleForm.verNewPwd" show-password></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <p class="be-sure" @click="pwdForget">确认</p>
  </el-form>
</template>
<script>
import { apiResetPwByMobile,apiGetValidCodePost,apiResetPwByEmail,apigetValidEmailPost } from "@/apis/api";
import { homePage } from "@/mixin/home";

export default {
  mixins: [homePage],
  props:{
    pwdType:{
      type:String,   // 1是手机，2是邮件
      default(){
        return 'mobile'
      }
    }
  },
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
        if (value === this.ruleForm.newPwd) {
          callback();
        } else {
          callback(new Error("两次输入的密码不一致"));
        }
      }, 100);
    };
    return {
      ruleForm: {
        mobile: "",
        email: "",
        vertifyMeg: "",
        newPwd: "",
        verNewPwd: ""
      },
      clickCodeFlag: false,
      timerNum: 5,
      timer: null,
      rules: {
        mobile: [{ required: true, validator: checkPhone, trigger: "blur" }],
        vertifyMeg: [{ required: true, message: "请输入验证码", trigger: "blur" }],
        newPwd:[
          { required: true, message: "请输入密码", trigger: "blur" },
          { min: 6, max: 18, message: "长度在6到18个字符", trigger: "blur" }
        ],
        verNewPwd: [{ required: true, validator: checkPwd, trigger: "blur" }],
        email: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ],
      }
    };
  },
  computed: {
    codeText() {
      if (this.clickCodeFlag) {
        return `${this.timerNum}s后失效`;
      }
      return "获取验证码";
    }
  },
  beforeDestroy() {
    clearInterval(this.timer);

  },
  methods: {
    mobileVaildCode(mobile){
      let params = {
        mobile: mobile 
      }
      apiGetValidCodePost(params).then(res => {
        if (res.data.code == 200) {
          this.clickCodeFlag = true;
          this.timer = setInterval(this.cutDown, 1000);
        }else{
          this.$message.error(res.data.msg);
        }
      });
    },
    emailVaildCode(email){
      let params = {
        email: email 
      }
      apigetValidEmailPost(params).then(res => {
        if (res.data.code == 200) {
          this.clickCodeFlag = true;
          this.timer = setInterval(this.cutDown, 1000);
        }else{
          this.$message.error(res.data.msg);
        }
      });
    },
    // 获取验证码
    getVertifyCode() {
      if (this.ruleForm.mobile || this.ruleForm.email) {
        if(this.pwdType === 'mobile'){
          this.mobileVaildCode(this.ruleForm.mobile)
        }else{
          this.emailVaildCode(this.ruleForm.email)
        }
      }
    },
    cutDown() {
      this.timerNum--;
      if (this.timerNum <= 0) {
        this.timerNum = 0;
        this.clickCodeFlag = false;
        clearInterval(this.timer);
      }
    },
    sendMobileData(){
      let params = {
        mobile: this.ruleForm.mobile,  //手机号
        validate_code:this.ruleForm.vertifyMeg, 
        new_password: this.ruleForm.newPwd,  //新密码
        re_password: this.ruleForm.verNewPwd  
      }
       apiResetPwByMobile(params).then(res => {
        if(res.data.code == 200){
          this.successPath = 2 // 2代表是修改成功
          this.$message.success("修改成功");
          this.toRegisterSuccessPageFn()
        }else{
          this.$message.error(res.data.msg);
        }
      });
    },
    sendEmailData(){
      let params = {
        email: this.ruleForm.email,  //手机号
        validate_code:this.ruleForm.vertifyMeg, 
        new_password: this.ruleForm.newPwd,  //新密码
        re_password: this.ruleForm.verNewPwd  
      }
      apiResetPwByEmail(params).then(res => {
        if(res.data.code == 200){
          this.successPath = 2 // 2代表是修改成功
          this.$message.success("修改成功");
          this.toRegisterSuccessPageFn()
        }else{
          this.$message.error(res.data.msg);
        }
      });
      
    },
    // 修改密码
    pwdForget(){
      this.$refs.ruleForm.validate((valid) => {
        if (valid) {
          if(this.pwdType === 'mobile'){
            this.sendMobileData()
          }else{
            this.sendEmailData()
          }
        } else {
          this.$message.error("输入信息不完整");
        }
      });
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