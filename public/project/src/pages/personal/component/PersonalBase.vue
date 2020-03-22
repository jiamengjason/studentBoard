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
              <el-col :span="8">
                <el-form-item label="旧密码：" prop="oldPassword">
                  <el-input v-model="ruleForm.oldPassword"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="4" :offset="2" class="forget-pwd">忘记密码？</el-col>
            </el-row>
            <!-- 新密码 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="新密码：" prop="newPassword">
                  <el-input v-model="ruleForm.newPassword"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 确认密码 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="确认密码：" prop="rePassword">
                  <el-input v-model="ruleForm.rePassword"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <p class="personal-save-btn">保存</p>
          </el-form>
        </el-tab-pane>
        <el-tab-pane label="修改邮箱">修改邮箱</el-tab-pane>
        <el-tab-pane label="修改手机号">修改手机号</el-tab-pane>
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
    return {
      text: "修改绑定信息",
      tabPosition: "left",
      ruleForm: {
        oldPassword: "",
        newPassword: "",
        rePassword: ""
      },
      rules: {
        oldPassword: [
          { required: true, message: "请输入旧密码", trigger: "blur" }
        ],
        newPassword: [
          { required: true, message: "请输入新密码", trigger: "blur" }
        ],
        rePassword: [
          { required: true, message: "请输入确认密码", trigger: "blur" }
        ]
      }
    };
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
    height: 317px;
    background: #fff;
    padding: 40px 50px;
    margin: 0 !important;
    border: 1px solid red;
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
}
// .modify-base-info {
.personal-page .el-tabs__item {
  height: 60px !important;
  line-height: 60px !important;
}
// }
</style>