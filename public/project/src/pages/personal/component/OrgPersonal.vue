<template>
  <div class="org-personal">
    <template v-if="activeName == 'organization1'">
      <TopTitle :text="text" />
      <el-row :gutter="20" class="student-base-info">
        <el-col :span="6">
          <div class="grid-content-first">
            <img v-if="ruleForm.headImg" :src="ruleForm.headImg" />
            <img v-else src="/img/img_org.png" />
            <p class="content-first-desc">
              支持jpg、png格式的图片
              <br />文件须小于1M
            </p>
            <el-upload
              action="''"
              class="content-first-btn"
              accept="image/jpeg,image/png,image/jpg"
              :show-file-list="false"
              :http-request="uploadHeadImg"
              :on-change="imageChange"
            >
              <span class="content-first-btn">{{ headUploadText }}</span>
            </el-upload>
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
                  <span v-if="ruleForm.identityImg" class="upload-state">已上传</span>
                  <span v-else class="upload-state">未上传</span>
                  <el-upload             
                    action="''"
                    class="add-info-img-btn"
                    accept="image/jpeg,image/png,image/jpg"
                    :show-file-list="false"
                    :http-request="uploadIdentityImg"
                    :on-change="imageChange"
                  >
                    <span>{{ uploadText }}</span>
                  </el-upload>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 保存 -->
            <p class="personal-top-save-btn" @click="saveOrgPublish">保存</p>
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
import { 
  apiGetUserInfo,
  apiResetUserUpdate,
  apiPostUploadFile 
} from "@/apis/api";

const uploadParam = new FormData() // 创建form对象


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
        headImg:"",
        organizationName: "" ,
        organizationEmail: "" ,
        organizationDesc: "" ,
        organizationYewu: "",
        organizationPhone: "",
        organizationWww: "",
        identityImg: ""
      },
      checkImg:true,
      uploadConfig:{},  // 上传的时候设置config
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

  computed: {
    uploadText(){
      if(this.ruleForm.identityImg){
        return '重新上传'
      }
      return '选取文件'
    },
    headUploadText(){
      if(this.ruleForm.headImg){
        return '修改头像'
      }
      return '选取文件'
    },
  },
  created() {
    this.getOrgInfo();
  },
  methods:{
    // 获取机构信息
    getOrgInfo(){
      let params = {
        userId:localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token')
      }
      apiGetUserInfo(params).then(res=>{
        if (res.data.code == 200) {      
          this.ruleForm = res.data.data;
          // 给父组件传用户信息值
          this.$emit('handleInfo',{
            headImg: res.data.data.headImg || '/img/img_org.png',
            userName: res.data.data.userName,
            mobile: res.data.data.mobile
          })
        }else{
          this.$message.error(res.data.msg);
        }
      })
    },
    imageChange(file) { 
      const isLt2M = file.size / 1024 / 1024 < 2;
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
        this.checkImg = false
      }else{
        this.checkImg = true
      } 
    },
    // 上传共有的方法
    uplaodFn(event){
      const file = event.file
      uploadParam.append('file', file) // 通过append向form对象添加数据
      this.uploadConfig = {
        headers: {'Content-Type': 'multipart/form-data'}
      }
    },
    // 上传头像
    uploadHeadImg(event){
      this.uplaodFn(event)
      if(this.checkImg){
        apiPostUploadFile(uploadParam, this.uploadConfig).then(res => {
          if (res.data.code == 200) {
            this.ruleForm.headImg = res.data.data.file_path    
          }else{
            this.$message.error(res.data.msg);
          }
        })
      }
    },
     // 上传身份证
    uploadIdentityImg(event) {
      this.uplaodFn(event)
      if(this.checkImg){
        apiPostUploadFile(param, this.uploadConfig).then(res => {
          if (res.data.code == 200) {
            this.ruleForm.identityImg = res.data.data.file_path    
          }else{
            this.$message.error(res.data.msg);
          }
        })
      }
    },
    // 发布
    saveOrgPublish(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        headImg: this.ruleForm.headImg,
        organizationName: this.ruleForm.organizationName,
        organizationEmail: this.ruleForm.organizationEmail,
        organizationDesc: this.ruleForm.organizationDesc,
        organizationYewu: this.ruleForm.organizationYewu,
        organizationPhone: this.ruleForm.organizationPhone,
        organizationWww: this.ruleForm.organizationWww,
        identityImg: this.ruleForm.identityImg
      }
      console.log(params,'params')
      apiResetUserUpdate(params).then(res=>{
        if (res.data.code == 200) {
          this.$message.success('修改成功');
          this.getOrgInfo() // 重新获取个人信息
        }else{
          this.$message.error(res.data.msg);
        }
      })
    }
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