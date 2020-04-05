<template>
  <el-form
    ref="ruleForm"
    :model="ruleForm"
    status-icon
    :rules="rules"
    label-width="110px"
    class="demo-ruleForm"
  >
    <el-row :gutter="10" style="margin-top:-118px">
      <el-col :span="8" :offset="5" class="school-spe-style">
        <el-form-item label="在读学校：" prop="school">
          <el-input v-model="ruleForm.school" class="vertify-code"></el-input>
          <el-select v-model="ruleForm.eduValue" placeholder="请选择学历" class="reg-education">
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
        <el-form-item ref="uploadpic" label="身份证：">
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
      <el-col :span="8" :offset="5">
        <el-form-item label="学生证：">
          <el-upload
            action="''"
            class="avatar-uploader"
            accept="image/jpeg,image/png,image/jpg"
            :show-file-list="false"
            :http-request="uploadStudentCardImg"
            :on-change="imageChange"
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
    <el-checkbox v-model="ruleForm.checked" class="check-agree">{{ ruleForm.imageId+'111' }}本人已阅并同意本站注册的要求内容</el-checkbox>
  </el-form>
</template>
<script>
import { mapGetters } from "vuex";
import { Message } from 'element-ui';
import { apiGetSiteConfig,apiGetValidCodePost,apiPostUploadFile } from "@/apis/api";
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
      checkImg:true,
      haspic: false, // 默认没有传图片
      images: [],
      dialogVisible: false,
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
  created() {
    this.getSiteConfig()
  },
  methods: {
    getSiteConfig(){
      apiGetSiteConfig().then(res => {
        console.log(res,'res')
      })
    },
    imageChange(file) { 
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isLt2M) {
        this.$message.error("上传头像图片只能是 JPG/PNG 格式!");
        alert("上传头像图片大小不能超过 2MB!");
        this.checkImg = false
      } 
    },
    uploadIdentityImg(event) {
      const file = event.file
      const param = new FormData() // 创建form对象
      param.append('file', file) // 通过append向form对象添加数据
      const config = {
        headers: {'Content-Type': 'multipart/form-data'}
      }
     if(this.checkImg){
       // 上传身份证
      apiPostUploadFile(param, config).then(res => {
        if (res.data.code == 200) {
          this.ruleForm.imageId = res.data.data.file_path    
        }
      })
     }
    },
    uploadStudentCardImg(event) {
      const file = event.file
      const param = new FormData() // 创建form对象
      param.append('file', file) // 通过append向form对象添加数据
      const config = {
        headers: {'Content-Type': 'multipart/form-data'}
      }
     if(this.checkImg){
       // 上传学生证
      apiPostUploadFile(param, config).then(res => {
        if (res.data.code == 200) {
          this.ruleRegForm.imageSchoolId = res.data.data.file_path ;
         
        }
      })
     }
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

  /* 在读学校 */
  .school-spe-style .el-form-item__content {
    display: flex;
  }
  .reg-education {
    width: 150px;
  }
  // .disabled .el-upload--picture-card {
  //   display: none;
  // }

</style>