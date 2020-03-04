<template>
  <div class="form-page">
    <el-form
      ref="ruleForm"
      :model="ruleForm"
      status-icon
      :rules="rules"
      label-width="100px"
      class="demo-ruleForm"
    >
      <el-row :gutter="20">
        <el-col :span="6">
          <el-form-item label="姓：" prop="surname">
            <el-input v-model="ruleForm.surname"></el-input>
          </el-form-item>
        </el-col>
        <el-col :span="6">
          <el-form-item label="名：" prop="name">
            <el-input v-model="ruleForm.name"></el-input>
          </el-form-item>
        </el-col>
      </el-row>

      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')">完成</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      ruleForm: {
        surname: "",
        name: ""
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
<style lang="scss">
.form-page {
  padding: 70px 60px;
}
</style>