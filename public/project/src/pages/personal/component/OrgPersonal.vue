<template>
  <div class="org-personal">
    <template v-if="activeName == 'organization1'">
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
            <!-- 机构名称、简介 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="名称：" prop="organizationName">
                  <el-input v-model="ruleForm.organizationName"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="5">
                <el-form-item label="简介：" prop="organizationDesc">
                  <el-input v-model="ruleForm.organizationDesc" type="textarea" class="org-desc"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 手机号码 -->
            <el-row :gutter="10">
              <el-col :span="8" style="margin-top:-50px;">
                <el-form-item label="手机号码：" class="text-left">
                  {{ ruleForm.organizationPhone }}
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 业务、官网 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="业务：" prop="organizationYewu">
                  <el-input v-model="ruleForm.organizationYewu"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="5">
                <el-form-item label="官网：" prop="organizationWww">
                  <el-input v-model="ruleForm.organizationWww"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 身份证 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="Email：" class="text-left">
                  {{ ruleForm.organizationEmail }}
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="5">
                <el-form-item label="身份证：" class="text-left">
                  <span>已上传</span>
                  <span>未上传</span>
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
    <OrgActivity v-if="activeName == 'organization2'" />
    <OrgRelease v-if="activeName == 'organization3'" />
  </div>
</template>
<script>
import TopTitle from "./TopTitle.vue";
import PersonBase from "./PersonalBase.vue";
import OrgActivity from "./OrgActivity.vue";
import OrgRelease from "./OrgRelease.vue";

export default {
  components: {
    TopTitle,
    PersonBase,
    OrgActivity,
    OrgRelease
  },
  props: {
    activeName: String
  },
  data() {
    return {
      text: "基本信息",
      ruleForm: {
        organizationName:"" ,
        organizationEmail:"organizationEmail" ,
        organizationDesc:"" ,
        organizationYewu: "",
        organizationPhone: "organizationPhone",
        organizationWww: ""
      },
    
      rules: {
        organizationName: [
          { required: true, message: "请输入机构名称", trigger: "blur" }
        ],
        organizationDesc: [{ required: true, message: "请输入简介", trigger: "blur" }],
        organizationYewu: [{ required: true, message: "请输入业务", trigger: "blur" }],
        organizationWww: [{ required: true, message: "请输入官网地址", trigger: "blur" }] 
      }
    };
  },
  created() {
    console.log(this.activeName, "activeName");
  }
};
</script>
<style lang="scss">
@import "@/assets/base.scss";

.org-personal {
  margin-top: 40px;
  .student-base-info {
    width: 100%;
    max-width: 1400px;
    background: #fff;
    padding: 50px;
    margin: 0 !important;
  }
  .org-desc{
    width: 300px;
    height: 110px;
    .el-textarea__inner{
      resize:none;
      padding: 20px;
    }
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
  }
  .text-left{
    text-align: left;
  }
  .personal-top-save-btn {
    width: 300px;
    height: 40px;
    background: orangeColor;
    border-radius: 5px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    margin-left: 100px;
    cursor: pointer;
  }
}
</style>