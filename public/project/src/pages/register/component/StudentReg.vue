<template>
  <el-form
    ref="ruleForm"
    :model="ruleForm"
    status-icon
    :rules="rules"
    label-width="110px"
    class="demo-ruleForm"
  >
    <el-row :gutter="10" style="margin-top:-100px">
      <el-col :span="8" :offset="5" class="school-spe-style">
        <el-form-item label="在读学校：" prop="school">
          <el-input v-model="ruleForm.school" class="vertify-code"></el-input>
          <el-select v-model="ruleForm.eduValue" placeholder="请选择学历" class="education">
            <el-option
              v-for="item in eduOptions"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            ></el-option>
          </el-select>
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
            <img v-if="ruleForm.imageId" :src="ruleForm.imageId" class="avatar" />
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
            <img v-if="ruleForm.imageSchoolId" :src="ruleForm.imageSchoolId" class="avatar" />
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
          <el-input v-model="ruleForm.vertifyMeg" class="vertify-code"></el-input>
          <el-button plain :disabled="clickCodeFlag" @click="getVertifyCode">{{ codeText }}</el-button>
        </el-form-item>
      </el-col>
    </el-row>
    <el-checkbox v-model="ruleForm.checked">本人已阅并同意本站注册的要求内容</el-checkbox>
  </el-form>
</template>
<script>
import { mapGetters } from "vuex";
import { apigetValidCodePost } from "@/apis/api";
export default {
  data() {
    return {
      ruleForm: {
        school: "",
        imageId: "",
        imageSchoolId: "",
        checked: true,
        vertifyMeg: "",
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

      clickCodeFlag: false,
      timerNum: 5,
      timer: null,
      rules: {
        school: [{ required: true, message: "", trigger: "blur" }],
        vertifyMeg: [{ required: true, message: "", trigger: "blur" }]
      }
    };
  },
  computed: {
    codeText() {
      if (this.clickCodeFlag) {
        return `${this.num}s后失效`;
      }
      return "获取验证码";
    },
    ...mapGetters({
      mobile: "getMobile"
    })
  },
  created() {},
  methods: {
    handleIdSuccess(res, file) {
      this.ruleRegForm.imageId = URL.createObjectURL(file.raw);
    },

    handleSchoolIdSuccess(res, file) {
      this.ruleRegForm.imageSchoolId = URL.createObjectURL(file.raw);
    },
    beforeAvatarUpload(file) {
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (["image/jpeg", "image/png", "image/jpg"].indexOf(file.type) < 0) {
        this.$message.error("上传头像图片只能是 JPG/PNG 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isLt2M;
    },
    // 获取验证码
    getVertifyCode() {
      if (this.mobile) {
        apigetValidCodePost({ mobile: this.mobile }).then(res => {
          consoel.log(1111, res);
          this.clickCodeFlag = true;
          this.timer = setInterval(this.cutDown, 1000);
        });
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
@import "./ele-reset.css";
.title {
  font-size: 22px;
  margin-bottom: 20px;
  font-weight: 700;
  text-align: left;
}
/* 在读学校 */
.school-spe-style .el-form-item__content {
  display: flex;
}
.education {
  width: 150px;
}
</style>