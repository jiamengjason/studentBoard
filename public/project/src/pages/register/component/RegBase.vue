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
    </el-row>
  </el-form>
</template>
<script>
export default {
  name: "RegBase",
  data() {
    return {
      ruleForm: {
        surname: "",
        name: "",
        pwd: "",
        truePwd: "",
        eamil: "",
        phone: ""
      },
      rules: {
        surname: [{ required: true, message: "", trigger: "blur" }],
        name: [{ required: true, message: "", trigger: "blur" }],
        pwd: [
          { required: true, message: "", trigger: "blur" },
          { min: 6, max: 18, message: "长度在6到18个字符", trigger: "blur" }
        ],
        truePwd: [
          { required: true, message: "", trigger: "blur" },
          { min: 6, max: 18, message: "长度在6到18个字符", trigger: "blur" }
        ],
        eamil: [{ required: true, message: "", trigger: "blur" }],
        phone: [{ required: true, message: "", trigger: "blur" }]
      }
    };
  },
  methods: {}
};
</script>
<style lang="scss" scoped>
</style>