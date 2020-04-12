<template>
  <div class="student-personal">
    <template v-if="activeName == 'student1'">
      <TopTitle :text="text" />
      <el-row :gutter="20" class="student-base-info">
        <el-col :span="6">
          <div class="grid-content-first">
            <img v-if="ruleForm.headImg" :src="ruleForm.headImg" />
            <img v-else src="/img/img_student.png" />
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
            <!-- 姓名 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="用户名：" prop="userName">
                  <el-input v-model="ruleForm.userName"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="4">
                <el-form-item label="Email：" class="text-left">
                  {{ ruleForm.email }}
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 在读学校 -->
            <el-row :gutter="20">
              <el-col :span="8" class="school-spe-style">
                <el-form-item label="在读学校：" prop="schoolName">
                  <el-input v-model="ruleForm.schoolName"></el-input>
                  <el-select v-model="ruleForm.grade" placeholder="请选择学历" class="education">
                    <el-option
                      v-for="(item,index) in eduOptions"
                      :key="index"
                      :label="item.label"
                      :value="item.value"
                    ></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="4">
                <el-form-item label="手机号码：" class="text-left">
                  {{ ruleForm.mobile }}
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 身份证 学生证 -->
            <el-row :gutter="20">
              <el-col :span="8">
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
              <el-col :span="8" :offset="4">
                <el-form-item label="学生证：" class="text-left">
                  <span v-if="ruleForm.studentCardImg" class="upload-state">已上传</span>
                  <span v-else class="upload-state">未上传</span>
                  <el-upload             
                    action="''"
                    class="add-info-img-btn"
                    accept="image/jpeg,image/png,image/jpg"
                    :show-file-list="false"
                    :http-request="uploadSchoolImg"
                    :on-change="imageChange"
                  >
                    <span>{{ schoolUploadText }}</span>
                  </el-upload>
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 保存 -->
            <p class="personal-top-save-btn" @click="updateUserInfo">保存</p>
          </el-form>
        </el-col>
      </el-row>
      <PersonBase />
    </template>
    <PersonalActivity v-if="activeName == 'student2'" />
    <!-- <ComActivity v-if="activeName == 'student3'" :act-list="actList" /> -->
    <Comment v-if="activeName == 'student3'" />
  </div>
</template>
<script>
import TopTitle from "./TopTitle";
import PersonBase from "./PersonalBase";
import PersonalActivity from "./PersonalActivity";
import Comment from "./Comment";
// import ComActivity from "@/components/Activity";
import { 
  apiGetSiteConfig,
  apiGetUserInfo,
  apiResetUserUpdate,
  apiPostUploadFile 
} from "@/apis/api";

const uploadParam = new FormData() // 创建form对象

export default {
  components: {
    TopTitle,
    PersonBase,
    PersonalActivity,
    Comment
  },
  props: {
    activeName: String
  },
  data() {
    return {
      actList:[1,23,4,5,6],
      text: "基本信息",
      ruleForm: {
        userName: "",
        mobile:"",
        email:"",
        schoolName: "",
        grade: "",
        headImg:"",
        identityImg: "https://www.baidu.com/img/bd_logo1.png",
        studentCardImg: ""
      },
      checkImg:true,
      eduOptions: [],
      uploadConfig:{}, // 上传的时候设置config
      rules: {
        userName: [
          { required: true, message: "请输入用户名", trigger: "blur" }
        ],
        schoolName: [{ required: true, message: "请输入学校", trigger: "blur" }]
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
    schoolUploadText(){
      if(this.ruleForm.studentCardImg){
        return '重新上传'
      }
      return '选取文件'
    }
  },
  created() {
    this.getSiteConfig();
    this.getUserInfo();
  },
  methods:{
    // 获取网站配置
    getSiteConfig(){
      apiGetSiteConfig().then(res => {
        if (res.data.code == 200) {
          this.eduOptions = res.data.data.grade_list;
        }else{
          this.$message.error(res.data.msg);
        }
      })
    },
    // 获取个人信息
    getUserInfo(){
      let params = {
        userId:localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token')
      }
      apiGetUserInfo(params).then(res=>{
        if (res.data.code == 200) {
            this.ruleForm = res.data.data;
            this.ruleForm.grade = Number(res.data.data.grade)
            // 给父组件传用户信息值
            this.$emit('handleInfo',{
              headImg: res.data.data.headImg || '/img/img_student.png',
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
        apiPostUploadFile(uploadParam, this.uploadConfig).then(res => {
          if (res.data.code == 200) {
            this.ruleForm.identityImg = res.data.data.file_path    
          }else{
            this.$message.error(res.data.msg);
          }
        })
      }
    },
    // 上传学生证
    uploadSchoolImg(event){
      this.uplaodFn(event)
      if(this.checkImg){
        apiPostUploadFile(uploadParam, this.uploadConfig).then(res => {
          if (res.data.code == 200) {
            this.ruleForm.studentCardImg = res.data.data.file_path    
          }else{
            this.$message.error(res.data.msg);
          }
        })
      }
    },
    // 更新个人中心的数据
    updateUserInfo(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        userName: this.ruleForm.userName,
        mobile: this.ruleForm.mobile,
        email: this.ruleForm.email,
        schoolName: this.ruleForm.schoolName,
        grade: this.ruleForm.grade,
        headImg: this.ruleForm.headImg,
        identityImg: this.ruleForm.identityImg,
        studentCardImg: this.ruleForm.studentCardImg
      }
      console.log(params,'params')
      apiResetUserUpdate(params).then(res=>{
        if (res.data.code == 200) {
          this.$message.success('修改成功');
          this.getUserInfo() // 重新获取个人信息
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
@import "../../register/component/ele-reset.css";
.student-personal {
  margin-top: 40px;
  .student-base-info {
    width: 100%;
    max-width: 1400px;
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
  .add-info-img-btn{
    width: 120px;
    height: 36px;
     background: $orangeColor;
    border-radius: 4px;
    line-height: 36px;
    color: #fff;
    font-size: 18px;
    text-align: center;
  }
  /* 在读学校 */
  .school-spe-style .el-form-item__content {
    display: flex;
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
  .text-left{
    text-align: left;
    .el-form-item__content{
      display: flex;
    }
    .upload-state{
      margin-right:10px;
      width: 50px;
    }
  }
 
  .personal-top-save-btn {
    cursor: pointer;
    cursor: pointer;
    width: 300px;
    height: 40px;
    background: $orangeColor;
    border-radius: 5px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    margin-left: 100px;
  }
}
</style>