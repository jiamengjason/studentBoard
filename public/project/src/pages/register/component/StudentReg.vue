<template>
  <div class="form-page">
    <!-- 基本信息 -->
    <p class="title">基本信息</p>
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
      <!-- 密码 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="设置密码：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="确认密码：" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- email -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="Email：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="确认Email：" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 学校 手机-->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="在读学校：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="手机号码：" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 证件 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="身份证：" prop="surname">
            <el-upload
              class="avatar-uploader"
              action="https://jsonplaceholder.typicode.com/posts/"
              :show-file-list="false"
              :on-success="handleAvatarSuccess"
              :before-upload="beforeAvatarUpload"
            >
              <img v-if="imageUrl" :src="imageUrl" class="avatar" />
              <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
          </el-form-item>
        </el-col>
        <el-col :span="8" :offset="5">
          <el-form-item label="学生证：" prop="name">
            <el-upload
              class="avatar-uploader"
              action="https://jsonplaceholder.typicode.com/posts/"
              :show-file-list="false"
              :on-success="handleAvatarSuccess"
              :before-upload="beforeAvatarUpload"
            >
              <img v-if="imageUrl" :src="imageUrl" class="avatar" />
              <i v-else class="el-icon-plus avatar-uploader-icon"></i>
            </el-upload>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 验证信息 -->
      <p class="title">验证信息</p>
      <el-row :gutter="20">
        <el-col :span="8">
          <el-form-item label="手机验证码：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- 完成 -->
      <el-checkbox v-model="checked">本人已阅并同意本站注册的要求内容</el-checkbox>
      <p>
        <el-button type="primary" @click="submitForm('ruleForm')">完成</el-button>
      </p>
    </el-form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      ruleForm: {
        surname: "",
        name: "",
        imageUrl: "",
        checked: true
      },
      rules: {
        surname: [{ required: true, message: "", trigger: "blur" }],
        name: [{ required: true, message: "", trigger: "blur" }]
      }
    };
  },
  methods: {
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