<template>
  <div class="userInfo">
    <div class="top-title-warp">
        <span class="top-title-line"></span>
        <span class="top-title-text">基本信息</span>
    </div>
    <el-card class="box-card">
        <el-form ref="userInfo" :model="userInfo" label-width="100px">
          <el-row>
            <el-col :span="12">
              <el-form-item label="用户名" required>
                <el-input v-model="userInfo.organizationName"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="手机号" required>
                <el-input v-model="userInfo.mobile" disabled="disabled"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row>
            <el-col :span="12"></el-col>
            <el-col :span="12"></el-col>
          </el-row>
          <el-row>
            <el-col :span="12">
              <el-form-item label="邮箱" required>
                <el-input v-model="userInfo.email" disabled="disabled"></el-input>
              </el-form-item>
            </el-col>
          
            <el-col :span="12">
              <el-form-item label="类型" required>
                <el-radio v-model="userInfo.organization_type" label="0">中介</el-radio>
                <el-radio v-model="userInfo.organization_type" label="1">培训</el-radio>
              </el-form-item>
            </el-col>
          </el-row>
        </el-form>
    </el-card>

    <div class="top-title-warp" style="margin-top:50px;">
        <span class="top-title-line"></span>
        <span class="top-title-text">详细信息</span>
    </div>
    <el-card class="box-card">
        <el-form ref="form" :model="userInfo" label-width="100px">
          <el-row>
            <el-col :span="12">
              <el-form-item label="官网">
                <el-input v-model="userInfo.organizationWww"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="机构电话">
                <el-input v-model="userInfo.organizationPhone"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="24">
              <el-form-item
                label="选择业务："                  
                :rules="{required: true, message: '请选择业务', trigger: 'change'}"
              >
                <el-checkbox-group v-model="organizationYewu" style="text-align:left;">
                  <el-checkbox-button v-for="item in yewuList" :key="item" :label="item">
                    {{ item }}
                  </el-checkbox-button>
                </el-checkbox-group>                
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="地址">
                <!-- <el-input v-model="form.name"></el-input> -->
                <treeselect v-model="userInfo.cityId" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择地址"/>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="详细地址">
                <el-input v-model="userInfo.detailAddr"></el-input>
              </el-form-item>
            </el-col>
          
            <el-col :span="24">
              <el-form-item label="机构简介">
                <el-input
                  type="textarea"
                  placeholder="请输入简介"
                  v-model="userInfo.organizationDesc"
                  maxlength="500"
                  show-word-limit
                >
                </el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row>
            <el-col :span="12"></el-col>
            <el-col :span="12"></el-col>
          </el-row>
          <el-row>
            <el-col :span="12"></el-col>
            <el-col :span="12"></el-col>
          </el-row>
          <el-row>
            <el-col :span="12"></el-col>
            <el-col :span="12"></el-col>
          </el-row>
        </el-form>
    </el-card>


    <div class="btns">
      <el-button type="primary" @click="onSubmit" round>&emsp;&emsp;保&emsp;&emsp;存&emsp;&emsp;</el-button>
    </div>
  </div>

</template>
<script>
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import citys from '../assets/data/citys.js'
import { 
  apiGetSiteConfig,
  apiResetUserUpdate,
  apiGetUserInfo
} from "../api";


  export default {
    name: 'userinfo',
    mounted(){
    },
    data() {
      return {
        userInfo:{},
        organizationYewu: [],
        yewuList:[],
        cityData: citys.citys
      }
    },
    created() {
      this.getSiteConfig();
      this.getOrgInfo();
    },
    components: {
      Treeselect
    },
    methods: {
      // 获取网站配置
      getSiteConfig(){
        apiGetSiteConfig().then(res => {
          if (res.data.code == 200) {
            this.yewuList = res.data.data.organization_yewu;
          }else{
            this.$message.error(res.data.msg);
          }
        })
      },
      // 获取机构信息
      getOrgInfo(){
        let params = {
          userId: this.GLOBAL.userId,
          token: this.GLOBAL.token
        }
        apiGetUserInfo(params).then(res=>{
          if (res.data.code == 200) {      
            this.userInfo = res.data.data;
            this.organizationYewu = res.data.data.organizationYewu;
            // 给父组件传用户信息值
            // this.$emit('handleInfo',{
            //   headImg: res.data.data.headImg || '/img/img_org.png',
            //   userName: res.data.data.userName,
            //   mobile: res.data.data.mobile
            // })
          }else{
            this.$message.error(res.data.msg);
          }
        })
      },
      onSubmit() {
        // 发布
        let params = {
          userId: this.GLOBAL.userId,
          token: this.GLOBAL.token,
          headImg: this.userInfo.headImg,
          organizationName: this.userInfo.organizationName,
          organizationEmail: this.userInfo.organizationEmail,
          organizationDesc: this.userInfo.organizationDesc,
          organizationYewu: this.organizationYewu,
          mobile: this.userInfo.mobile,
          cityId:this.userInfo.cityId,  
          detailAddr: this.userInfo.detailAddr,
          organizationWww: this.userInfo.organizationWww,
          organizationPhone:this.userInfo.organizationPhone,
          identityImg: this.userInfo.identityImg
        }
        console.log(params,'params')
        this.$refs.userInfo.validate((valid) => {
          if (valid) {
            if(this.organizationYewu.length > 0){
              apiResetUserUpdate(params).then(res=>{
                if (res.data.code == 200) {
                  this.$message.success('修改成功');
                  this.getOrgInfo() // 重新获取个人信息
                }else{
                  this.$message.error(res.data.msg);
                }
              })
            }else{
              this.$message.error('输入信息不完整');
            }          
          } else {
            this.$message.error('输入信息不完整');
          }
        })
        
      }
    }
  }
</script>
<style lang="scss" scoped>
    .userInfo{
        margin: 20px;
    }

    .top-title-warp {
        width: 100%;
        max-width: 1400px;
        height: 50px;
        background: #fff;
        line-height: 50px;
        border-bottom: 2px solid #dae2f8;
        text-align: left;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        .top-title-line {
            width: 4px;
            height: 22px;
            background: #dae2f8;
            display: inline-block;
            margin: 0 10px 0 40px;
            vertical-align: sub;
        }
        .top-title-text {
            font-size: 16px;
            color: #162f3b;
        }
    }

    .btns{
      margin-top: 50px;
      text-align: center;
    }
</style>