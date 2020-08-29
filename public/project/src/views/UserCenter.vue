<template>
  <div class="bg2">
    <!-- 头部 -->
    <Header></Header>
    <div class="container containerBgColor1 usercenter">
        <div class="personal-top-com">
            <div class="top-img">
                <el-row>
                    <el-col :span="4">
                        <div class="top-head-img">
                            <el-avatar :size="120" icon="el-icon-user-solid" :src="ruleForm.headImg">
                            </el-avatar>
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
                    <el-col :span="20">
                        <p class="top-name">{{ ruleForm.userName }}</p>
                        <p class="top-mobile">{{ ruleForm.email }}</p>
                        <el-button type="warning" icon="el-icon-plus" circle class="addWord" title="发布文章"></el-button>
                    </el-col>
                </el-row>
            </div>
        </div>

        <div class="usercenter-tagcon">
            <el-tabs type="card" v-model="activeName" @tab-click="handleClick">
                <el-tab-pane label="个人中心" name="first">
                    <UserInfoOrg :userInfo="ruleForm" v-if="ruleForm.roleId==1"></UserInfoOrg>
                    <UserInfoTeacher :userInfo="ruleForm" v-if="ruleForm.roleId==2"></UserInfoTeacher>
                    <UserInfoParent :userInfo="ruleForm" v-if="ruleForm.roleId==3"></UserInfoParent>
                    <UserInfoStudent :userInfo="ruleForm" v-if="ruleForm.roleId==4"></UserInfoStudent>
                </el-tab-pane>
                <el-tab-pane label="参加活动" name="second" v-if="ruleForm.roleId!=1">参加活动</el-tab-pane>
                <el-tab-pane label="我的评价" name="third" v-if="ruleForm.roleId!=1">我的评价</el-tab-pane>
                <el-tab-pane label="我的文章" name="four" v-if="ruleForm.roleId==1">我的文章</el-tab-pane>
                <el-tab-pane label="活动列表" name="five" v-if="ruleForm.roleId==1">
                  <activityList/>
                </el-tab-pane>
                <el-tab-pane label="发布活动" name="six" v-if="ruleForm.roleId==1">
                  <activityAdd/>
                </el-tab-pane>
            </el-tabs>
        </div>
        
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
</template>

<script>
  import Header from '../components/Header.vue'
  import Footer from '../components/Footer.vue'
  import UserInfoOrg from '../components/user_info_O.vue'
  import UserInfoTeacher from '../components/user_info_T.vue'
  import UserInfoParent from '../components/user_info_P.vue'
  import UserInfoStudent from '../components/user_info_S.vue'
  import activityAdd from '../components/activityAdd.vue'
  import activityList from '../components/activityList.vue'

  import { 
    apiGetSiteConfig,
    apiGetUserInfo,
    apiResetUserUpdate,
    apiPostUploadFile 
  } from "../api";
const uploadParam = new FormData() // 创建form对象

  export default {
    name: 'usercenter',
    data() {
      return {
        ruleForm: {
          headImg:"",
          organizationName: "" ,
          organizationEmail: "" ,
          organizationPhone: "",
          organizationDesc: "" ,
          mobile: "",
          organizationWww: "",
          identityImg: "",      
        },
        activeName: 'first',
        name: '',
        pwd: '',
        radio:'',
        userInfo: {}
      }
    },
    computed: {
      headUploadText(){
        if(this.ruleForm.headImg){
          return '修改头像'
        }
        return '选取文件'
      }
    },
    mounted(){
    },
    components: {
      Header,
      Footer,
      UserInfoOrg,
      UserInfoTeacher,
      UserInfoStudent,
      UserInfoParent,
      activityAdd,
      activityList
    },
    created() {
      this.getSiteConfig();
      this.getUserInfo();
    },
    methods: {
      // 获取网站配置
      getSiteConfig(){
        apiGetSiteConfig().then(res => {
          if (res.data.code == 200) {
            this.yewuList = res.data.data.organization_yewu;
          }else{
            this.$message.error(res.data.msg);
            this.clearCookies();
            this.$router.push({name: 'login'})
            this.$router.go(0)
          }
        })
      },
      // 获取机构信息
      getUserInfo(){
        let params = {
          userId: this.GLOBAL.userId,
          token: this.GLOBAL.token
        }
        apiGetUserInfo(params).then(res=>{
          if (res.data.code == 200) {      
            this.ruleForm = res.data.data;
            this.organizationYewu = res.data.data.organizationYewu;
          }else{
            this.$message.error(res.data.msg);
            this.clearCookies();
            this.$router.push({name: 'login'})
            this.$router.go(0)
          }
        })
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
      // 上传共有的方法
      uplaodFn(event){
        const file = event.file
        uploadParam.append('file', file) // 通过append向form对象添加数据
        this.uploadConfig = {
          headers: {'Content-Type': 'multipart/form-data'}
        }
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
      handleClick(){
        
      }
    }
  }
</script>

<style lang="scss" scoped>
// 顶部样式
.personal-top-com {
  width: 100%;
  .top-img {
    width: 100%;
    .top-head-img {
      display: block;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 30px auto 30px auto;
      .el-avatar--icon{
        font-size: 70px;
      }
    }
    .top-name {
      margin-top: 60px;
      font-size: 28px;
      color: rgba(51, 51, 51, 1);
    }
    .top-mobile {
      margin-top: 6px;
      font-size: 22px;
      color: rgba(102, 102, 102, 1);
    }
    .addWord{
        position: absolute;
        right: 50px;
        top: 50px;
    }
  }
}

.usercenter-tagcon{
    padding: 0 50px 50px 50px;
    .el-tabs__nav-wrap::after{
        background-color: #999;;
    }
}
</style>
