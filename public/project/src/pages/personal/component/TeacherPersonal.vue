<template>
  <div class="teacher-personal">
    <template v-if="activeName == 'teacher1'">
      <TopTitle :text="text" />
      <el-row :gutter="20" class="student-base-info">
        <el-col :span="6">
          <div class="grid-content-first">
            <img :src="ruleForm.identityImg" />
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
              <span class="content-first-btn">选取文件</span>
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
              <el-col :span="8" :offset="5">
                <el-form-item label="Email：" class="text-left">
                  {{ ruleForm.email }}
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 机构、手机号 -->
            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item label="机构：" prop="parentId">
                  <el-select v-model="ruleForm.parentId" placeholder="请选择机构" class="education">
                    <el-option
                      v-for="item in orgOptions"
                      :key="item.value"
                      :label="item.label"
                      :value="item.value"
                    ></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="8" :offset="5">
                <el-form-item label="手机号：" class="text-left">
                  {{ ruleForm.mobile }}
                </el-form-item>
              </el-col>
            </el-row>
            <!-- 身份证 -->
            <el-row :gutter="10">
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
                    <span>选取文件</span>
                  </el-upload>
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
import { 
  apiGetOrganizationList,
  apiGetUserInfo,
  apiResetUserUpdate,
  apiPostUploadFile 
} from "@/apis/api";

export default {
  components: {
    TopTitle,
    PersonBase,
    PersonalActivity
  },
  props: {
    activeName: String
  },
  data() {
    return {
      text: "基本信息",
      ruleForm: {
        headImg:"",
        userName: "",
        email: "email",
        mobile: "email",
        parentId: "",
        identityImg:""
      },
      orgOptions: [],
      rules: {
        userName: [{ required: true, message: "请输入用户名", trigger: "blur" }],
        parentId: [{ required: true, message: "请选择机构", trigger: "blur" }]
      }
    };
  },
  created() {
    this.getUserInfo();
    this.getOrganizationList();
  },
  methods:{
    // 获取网站配置
    getOrganizationList(){
      apiGetOrganizationList().then(res => {
        if (res.data.code == 200) {
          this.orgOptions = res.data.data;
        }else{
          this.$message.error(res.data.msg);
        }
      })
    },
    // 获取个人信息
    getUserInfo(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
      }
      apiGetUserInfo(params).then(res=>{
        if (res.data.code == 200) {
          console.log(res.data.data,'res.data.data;')
            this.ruleForm = res.data.data;
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
      const param = new FormData() // 创建form对象
      param.append('file', file) // 通过append向form对象添加数据
      this.uploadConfig = {
        headers: {'Content-Type': 'multipart/form-data'}
      }
    },
    // 上传头像
    uploadHeadImg(){
      this.uplaodFn(event)
      if(this.checkImg){
        apiPostUploadFile(param, this.uploadConfig).then(res => {
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
    // 更新个人中心的数据
    updateUserInfo(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        userName: this.ruleForm.userName,
        mobile: this.ruleForm.mobile,
        email: this.ruleForm.email,
        parentId: this.ruleForm.parentId,
        headImg: this.ruleForm.headImg,
        identityImg: this.ruleForm.identityImg
      }
      apiResetUserUpdate(params).then(res=>{
        if (res.data.code == 200) {
          this.$message.success('修改成功');
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

.teacher-personal {
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
      width: 300px;
      .el-input__inner {
        width: 300px;
      }
    }
  }
  .text-left {
    text-align: left;
  }
  .personal-top-save-btn {
    cursor: pointer;
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