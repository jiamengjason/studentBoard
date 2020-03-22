<template>
  <div class="base-personal">
    <TopTitle :text="text" />
    <div class="modify-base-info">
      <el-tabs :tab-position="tabPosition" style="height: 230px;">
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
                  <el-input v-model="ruleForm.oldPassword"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="4" :offset="2" class="forget-pwd">忘记密码？</el-col>
            </el-row>
            <!-- 新密码 -->
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="新密码：" prop="newPassword">
                  <el-input v-model="ruleForm.newPassword"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 确认密码 -->
            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item label="确认密码：" prop="rePassword">
                  <el-input v-model="ruleForm.rePassword"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn">保存</p>
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
                  <el-input v-model="ruleEmail.validCode"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn">保存</p>
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
            <p class="personal-save-btn">保存</p>
          </el-form>
        </el-tab-pane>
      </el-tabs>
    </div>
  </div>
</template>
<script>
import TopTitle from "./TopTitle.vue";
export default {
  components: {
    TopTitle
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
          { required: true, message: "请输入新密码", trigger: "blur" }
        ],
        rePassword: [
          { required: true, message: "请输入确认密码", trigger: "blur" }
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
        return `${this.num}s后失效`;
      }
      return "获取验证码";
    }
  },
  methods: {
    // 获取验证码
    getVertifyCode() {
      if (this.ruleMobile.newMobile) {
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
    width: 300px;
    height: 40px;
    background: rgba(255, 112, 1, 1);
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
    font-size: 14px;
    margin-top: 10px;
  }
  .vertify-code,
  .vertify-code .el-input__inner {
    width: 170px !important;
    margin-right: 20px;
  }
}
// .modify-base-info {
.personal-page .el-tabs__item {
  height: 60px !important;
  line-height: 60px !important;
}
// }
</style>