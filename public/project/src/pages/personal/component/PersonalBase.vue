<template>
  <div class="base-personal">
    <TopTitle :text="text" />
    <div class="modify-base-info">
      <el-tabs :tab-position="tabPosition" style="height: 240px;">
        <el-tab-pane label="修改密码">
          <el-form
            ref="ruleForm"
            :model="ruleForm"
            status-icon
            :rules="rules"
            label-width="100px"
            class="personal-ruleForm"
          >
            <!-- 旧密码 -->
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="旧密码：" prop="oldPassword">
                  <el-input v-model="ruleForm.oldPassword" show-password></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="4" :offset="2" class="forget-pwd" @click="toPwdPageFn">忘记密码？</el-col>
            </el-row>
            <!-- 新密码 -->
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="新密码：" prop="newPassword">
                  <el-input v-model="ruleForm.newPassword" show-password></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 确认密码 -->
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="确认密码：" prop="rePassword">
                  <el-input v-model="ruleForm.rePassword" show-password></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn" @click="updateUnionPwd">保存</p>
          </el-form>
        </el-tab-pane>
        <el-tab-pane label="修改邮箱">
          <el-form
            ref="ruleEmail"
            :model="ruleEmail"
            status-icon
            :rules="rules"
            label-width="100px"
            class="personal-ruleForm"
          >
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="新邮箱：" prop="newEmail">
                  <el-input v-model="ruleEmail.newEmail"></el-input>
                </el-form-item>
                <el-form-item label="验证码：" prop="validCode">
                  <el-input v-model="ruleEmail.validCode" class="vertify-code"></el-input>
                  <el-button plain :disabled="clickCodeFlag" @click="getEmailVertifyCode">{{ codeText }}</el-button>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn" @click="updateUnionEmail">保存</p>
          </el-form>
        </el-tab-pane>
        <el-tab-pane label="修改手机号">
          <el-form
            ref="ruleMobile"
            :model="ruleMobile"
            status-icon
            :rules="rules"
            label-width="100px"
            class="personal-ruleForm"
          >
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="手机号：" prop="newMobile">
                  <el-input v-model="ruleMobile.newMobile"></el-input>
                </el-form-item>
                <el-form-item label="验证码：" prop="validCode">
                  <el-input v-model="ruleMobile.vertifyMeg" class="vertify-code"></el-input>
                  <el-button plain :disabled="clickCodeFlag" @click="getVertifyCode">{{ codeText }}</el-button>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn" @click="updateUnionMobile">保存</p>
          </el-form>
        </el-tab-pane>
      </el-tabs>
    </div>
  </div>
</template>
<script>
import TopTitle from "./TopTitle.vue";
import { homePage } from "@/mixin/home";
import { checkPhone } from "@/utils/common";
import { apiResetUpdateUnion,apigetValidEmailPost,apiGetValidCodePost } from "@/apis/api";
export default {
  components: {
    TopTitle
  },
  mixins: [homePage],
  data() {   
    // 确认密码验证
    let checkPwd = (rule, value, callback) => {
      if (!value) {
        return callback(new Error("请确认您的密码"));
      }
      setTimeout(() => {
        if (value === this.ruleForm.newPassword) {
          callback();
        } else {
          callback(new Error("两次输入的密码不一致"));
        }
      }, 100);
    };
    return {
      text: "修改绑定信息",
      tabPosition: "left",
      ruleForm: {
        oldPassword: "",
        newPassword: "",
        rePassword: ""
      },
      ruleEmail: {
        newEmail: "",
        validCode: ""
      },
      ruleMobile: {
        newMobile: "",
        vertifyMeg: ""
      },
      clickCodeFlag: false,
      timerNum: 5,
      timer: null,
      rules: {
        oldPassword: [
          { required: true, message: "请输入旧密码", trigger: "blur" }
        ],
        newPassword: [
          { required: true, message: "请输入新密码", trigger: "blur" },
          { min: 6, max: 18, message: "长度在6到18个字符", trigger: "blur" }
        ],
        rePassword: [
          { required: true, validator: checkPwd, trigger: "blur" }
        ],
        newEmail: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ],
        newMobile: [{ required: true, validator: checkPhone, trigger: "blur" }],
        validCode: [
          { required: true, message: "请输入验证码", trigger: "blur" }
        ]
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
  methods: {
    // 获取验证码
    getVertifyCode() {
      if (this.ruleMobile.newMobile) {
        apiGetValidCodePost({ mobile: this.ruleMobile.newMobile }).then(res => {
          if (res.data.code == 200) {
            this.clickCodeFlag = true;
            this.timer = setInterval(this.cutDown, 1000);
          }else{
            this.$message.error(res.data.msg);
          }
        });
      }else{
        this.$message.error("请输入的手机号码");
      }
    },
    // 获取邮箱验证码
    getEmailVertifyCode(){
      if (this.ruleEmail.newEmail) {
        apigetValidEmailPost({ email: this.ruleEmail.newEmail }).then(res => {
          if (res.data.code == 200) {
            this.clickCodeFlag = true;
            this.timer = setInterval(this.cutDown, 1000);
          }else{
            this.$message.error(res.data.msg);
          }
        });
      }else{
        this.$message.error("请输入的邮箱");
      }
    },
    // 倒计时
    cutDown() {
      this.timerNum--;
      if (this.timerNum <= 0) {
        this.timerNum = 0;
        this.clickCodeFlag = false;
        clearInterval(this.timer);
      }
    },
    modifyRequest(params){
      apiResetUpdateUnion(params).then(res=>{
        if (res.data.code == 200) {
          this.$message.success('修改成功');
          // 修改完密码后跳转至登录页面
          if(params.type == 1){
            this.$router.push("/login");
          }
        }else{
          this.$message.error(res.data.msg);
        }
      })
    },
    // 保存密码
    updateUnionPwd(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        type: 1,  //1修改密码 2修改邮箱 3修改手机号
        oldPassword: this.ruleForm.oldPassword,
        newPassword: this.ruleForm.newPassword,
        rePassword: this.ruleForm.rePassword
      }
      this.modifyRequest(params);
    },
    // 保存邮箱
    updateUnionEmail(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        type: 2,  //1修改密码 2修改邮箱 3修改手机号
        newEmail: this.ruleEmail.newEmail,
        validCode: this.ruleEmail.validCode
      }
      this.modifyRequest(params);
    },
    // 保存手机号
    updateUnionMobile(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        type: 3,  //1修改密码 2修改邮箱 3修改手机号
        newMobile: this.ruleMobile.newMobile,
        validCode: this.ruleMobile.vertifyMeg
      }
      this.modifyRequest(params)
    }
  }
};
</script>
<style lang="scss">
@import "@/assets/base.scss";

.base-personal {
  margin-top: 40px;
  .modify-base-info {
    width: auto;
    max-width: 1400px;
    // height: 317px;
    background: #fff;
    padding: 40px 50px;
    margin: 0 !important;
  }

  .el-tabs__item {
    font-weight: normal;
  }
  .el-tab-pane {
    display: block;
  }
  .personal-save-btn {
    cursor: pointer;
    width: 300px;
    height: 40px;
    background: $orangeColor;
    border-radius: 5px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    margin-left: 100px;
  }
  .el-tabs--left .el-tabs__header.is-left {
    margin-right: 180px;
  }
  .forget-pwd {
    cursor: pointer;
    font-size: 14px;
    margin-top: 10px;
  }
  .vertify-code,
  .vertify-code .el-input__inner {
    width: 170px !important;
    margin-right: 20px;
  }
}
.personal-page .el-input__suffix{
  right: 14px;
}
// .modify-base-info {
.personal-page .el-tabs__item {
  height: 60px !important;
  line-height: 60px !important;
}
// }
</style>