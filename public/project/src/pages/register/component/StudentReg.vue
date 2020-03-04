<template>
  <div class="form-page">
    <!-- 基本信息 -->
    <p class="title">基本信息</p>
    <comRegBase />
    <el-form
      ref="ruleForm"
      :model="ruleForm"
      status-icon
      :rules="rules"
      label-width="100px"
      class="demo-ruleForm"
    >
      <!-- <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="姓：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="名：" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
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
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="Email：" prop="eamil">
            <el-input v-model="ruleForm.eamil"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="手机号码：" prop="phone">
            <el-input v-model="ruleForm.phone"></el-input>
          </el-form-item>
        </el-col>
      </el-row>-->

      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="在读学校：" prop="school">
            <el-input v-model="ruleForm.school"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 证件 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="身份证：">
            <el-upload
              class="avatar-uploader"
              action="https://jsonplaceholder.typicode.com/posts/"
              :show-file-list="false"
              :on-success="handleIdSuccess"
              :before-upload="beforeAvatarUpload"
            >
              <img v-if="imageId" :src="imageId" class="avatar" />
              <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="学生证：">
            <el-upload
              class="avatar-uploader"
              action="https://jsonplaceholder.typicode.com/posts/"
              :show-file-list="false"
              :on-success="handleSchoolIdSuccess"
              :before-upload="beforeAvatarUpload"
            >
              <img v-if="imageSchoolId" :src="imageSchoolId" class="avatar" />
              <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 验证信息 -->
      <p class="title">验证信息</p>
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="手机验证码：" prop="vertifyMeg">
            <el-input v-model="ruleForm.vertifyMeg"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 完成 -->
      <el-checkbox v-model="ruleForm.checked">本人已阅并同意本站注册的要求内容</el-checkbox>
      <p>
        <el-button type="primary" @click="submitForm('ruleForm')">完成</el-button>
      </p>
    </el-form>
  </div>
</template>
<script>
import comRegBase from "./RegBase.vue";
export default {
  components: { comRegBase },
  data() {
    return {
      ruleForm: {
        school: "",
        imageId: "",
        imageSchoolId: "",
        checked: true,
        vertifyMeg: ""
      },
      rules: {
        school: [{ required: true, message: "", trigger: "blur" }],
        vertifyMeg: [{ required: true, message: "", trigger: "blur" }]
      }
    };
  },
  methods: {
    handleIdSuccess(res, file) {
      this.imageId = URL.createObjectURL(file.raw);
    },

    handleSchoolIdSuccess(res, file) {
      this.imageSchoolId = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isPNG = file.type === "image/png";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG || !isPNG) {
        this.$message.error("上传头像图片只能是 JPG/PNG 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isJPG && isPNG && isLt2M;
    },
    //  完成注册
    submitForm(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          alert("submit!");
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    }
  }
};
</script>
<style lang="scss" scoped>
@import "./ele-reset.css";

.form-page {
  padding: 70px 60px;
}
.title {
  font-size: 22px;
  margin-bottom: 20px;
  font-weight: 700;
  text-align: left;
}
</style>