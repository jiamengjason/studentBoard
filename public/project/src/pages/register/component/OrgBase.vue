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
        <el-form-item label="用户名：" prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8" :offset="5">
        <el-form-item label="Email：" prop="eamil">
          <el-input v-model="ruleForm.eamil"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <!-- email -->
    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="机构简介：">
          <el-input v-model="ruleForm.orgIntro" type="textarea" class="org-intro"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
  </el-form>
</template>
<script>
import { mapMutations } from "vuex";
export default {
  name: "RegBase",
  data() {
    return {
      ruleForm: {
        name: "",
        eamil: "",
        orgIntro: ""
      },
      rules: {
        name: [{ required: true, message: "请输入用户名", trigger: "blur" }],
        eamil: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ]
      }
    };
  },
  computed: {},
  watch: {},
  mounted() {},
  methods: {
    ...mapMutations(["setMobile"]),
    updatePhone(e) {
      console.log(e, 11111);
      this.setMobile(e);
      // store.commit('setMobile', e.target.value)
    }
  }
};
</script>
<style lang="scss">
.org-intro {
  .el-textarea__inner {
    width: 300px;
    height: 150px;
  }
  .el-textarea__inner:focus {
    border-color: #999;
  }
}
</style>