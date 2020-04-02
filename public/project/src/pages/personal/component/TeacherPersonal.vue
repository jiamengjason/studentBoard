<template>
  <div class="student-personal">
    <template v-if="activeName == 'teacher1'">
      <TopTitle :text="text" />
      <el-row :gutter="20" class="student-base-info">
        <el-col :span="6">
          <div class="grid-content-first">
            <img src alt />
            <p class="content-first-desc">
              支持jpg、png格式的图片
              <br />文件须小于1M
            </p>
            <p class="content-first-btn">上传头像</p>
          </div>
        </el-col>
        <el-col :span="18">
          <el-form
            ref="ruleForm"
            :model="ruleForm"
            status-icon
            :rules="rules"
            label-width="100px"
            class="personal-ruleForm"
          >
            <!-- 姓名 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="用户名：" prop="userName">
                  <el-input v-model="ruleForm.userName"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="5">
                <el-form-item label="Email：" prop="eamil">
                  <el-input v-model="ruleForm.eamil"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 身份证 -->
            <el-row :gutter="10">
              <el-col :span="8">
                <el-form-item label="身份证：">
                  <el-input v-model="ruleForm.identityImg"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 保存 -->
            <p class="personal-top-save-btn">保存</p>
          </el-form>
        </el-col>
      </el-row>
      <PersonBase />
    </template>
    <PersonalActivity v-if="activeName == 'teacher2'" />
  </div>
</template>
<script>
import TopTitle from "./TopTitle.vue";
import PersonBase from "./PersonalBase.vue";
import PersonalActivity from "./PersonalActivity.vue";

export default {
  components: {
    TopTitle,
    PersonBase,
    PersonalActivity
  },
  data() {
    return {
      text: "基本信息",
      ruleForm: {
        name: "",
        eamil: "",
        mobile: "",
        school: "",
        eduValue: ""
      },
      eduOptions: [
        {
          value: "选项1",
          label: "黄金糕"
        },
        {
          value: "选项2",
          label: "双皮奶"
        }
      ],
      rules: {
        name: [{ required: true, message: "请输入用户名", trigger: "blur" }],
        eamil: [
          { required: true, message: "请输入Email", trigger: "blur" },
          { type: "email", message: "请输入正确的Email", trigger: "blur" }
        ],
        mobile: [{ required: true, message: "请输入手机号", trigger: "blur" }],
        school: [{ required: true, message: "请输入学校", trigger: "blur" }]
      }
    };
  }
};
</script>
<style lang="scss">
@import "@/assets/base.scss";

.student-personal {
  margin-top: 40px;
  .student-base-info {
    width: 100%;
    max-width: 1400px;
    // height: 317px;
    background: #fff;
    padding: 50px;
    margin: 0 !important;
  }
  .grid-content-first {
    img {
      display: block;
      width: 110px;
      height: 110px;
      border-radius: 50%;
      border: 1px solid #d3dce6;
      margin: 0 auto;
    }
    .content-first-desc {
      font-size: 12px;
      color: rgba(153, 153, 153, 1);
      margin: 12px 0;
    }
    .content-first-btn {
      width: 110px;
      height: 40px;
      background: $orangeColor;
      border-radius: 5px;
      line-height: 40px;
      color: #fff;
      font-size: 18px;
      text-align: center;
      margin: 0 auto;
    }
  }
  .personal-ruleForm {
    margin: 0;
    .el-input__inner {
      width: 300px;
    }
    .school-spe-style .el-input__inner {
      width: 150px;
    }
    .education {
      .el-input__inner {
        width: 130px;
      }
      margin-left: 20px;
    }
  }
  .personal-top-save-btn {
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
}
</style>