<template>
  <el-form
    ref="ruleForm"
    :model="ruleForm"
    status-icon
    :rules="rules"
    label-width="110px"
    class="demo-ruleForm"
  >
    <!-- 证件 -->
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="身份证：">
          <el-upload
            action="''"
            class="avatar-uploader"
            accept="image/jpeg,image/png,image/jpg"
            :show-file-list="false"
            :http-request="uploadIdentityImg"
            :on-change="imageChange"
          >
            <img v-if="ruleForm.imageId" :src="ruleForm.imageId" class="avatar" />
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>
      </el-col>
    </el-row>
    <!-- 验证信息 -->
    <p class="title">
      <img src="/img/icon_verify.png" alt="">
      验证信息
    </p>
    <el-row :gutter="20">
      <el-col :span="8">
        <el-form-item label="手机验证码：" prop="vertifyMeg">
          <el-input v-model="ruleForm.vertifyMeg" class="vertify-code"></el-input>
          <el-button plain :disabled="clickCodeFlag" @click="getVertifyCode">{{ codeText }}</el-button>
        </el-form-item>
      </el-col>
    </el-row>
    <el-checkbox v-model="ruleForm.checked" class="check-agree">本人已阅并同意本站注册的要求内容</el-checkbox>
  </el-form>
</template>
<script>
import { mapGetters } from "vuex";
import { apiGetValidCodePost,apiPostUploadFile } from "@/apis/api";


export default {
  data() {
    return {
      ruleForm: {
        imageId: "",
        checked: true,
        vertifyMeg: ""
      },
      checkImg: true,
      clickCodeFlag: false,
      timerNum: 5,
      timer: null,
      rules: {
        vertifyMeg: [{ required: true, message: "", trigger: "blur" }]
      }
    };
  },
  computed: {
    codeText() {
      if (this.clickCodeFlag) {
        return `${this.timerNum}s后失效`;
      }
      return "获取验证码";
    },
    ...mapGetters({
      mobile: "getMobile"
    })
  },
   created() {
    
  },
  beforeDestroy() {
    clearInterval(this.timer);   
  },
  methods: {
    imageChange(file) { 
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
        this.checkImg = false
      } 
    },
     // 上传身份证
    uploadIdentityImg(event) {
      const file = event.file
      const param = new FormData() // 创建form对象
      param.append('file', file) // 通过append向form对象添加数据
      const config = {
        headers: {'Content-Type': 'multipart/form-data'}
      }
     if(this.checkImg){
      apiPostUploadFile(param, config).then(res => {
        if (res.data.code == 200) {
          this.ruleForm.imageId = res.data.data.file_path    
        }else{
          this.$message.error(res.data.msg);
        }
      })
     }
    },
    // 获取验证码
    getVertifyCode() {
      if (this.mobile) {
        apiGetValidCodePost({ mobile: this.mobile }).then(res => {
          if (res.data.code == 200) {
            this.clickCodeFlag = true;
            this.timer = setInterval(this.cutDown, 1000);
          }else{
            this.$message.error(res.data.msg);
          }
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
<style lang="scss" scoped>
@import "./ele-reset.css";
.organization {
  width: 300px;
}
</style>