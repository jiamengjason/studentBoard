<template>
  <div class="userInfo">
    <div class="top-title-warp">
        <span class="top-title-line"></span>
        <span class="top-title-text">发布活动</span>
    </div>
    <el-card class="box-card">
        <el-form ref="ruleForm" :model="ruleForm" label-width="100px">
          <el-row>

            <el-col :span="24">
              <el-form-item label="活动图片" required>
                <el-upload
                  action="''"
                  class="avatar-uploader"
                  accept="image/jpeg,image/png,image/jpg"
                  :show-file-list="false"
                  :http-request="uploadTitleImg"
                  :on-change="imageChange"
                >
                  <img v-if="ruleForm.headImg" :src="ruleForm.headImg" class="avatar" />
                  <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
              </el-form-item>
            </el-col>

            <el-col :span="24">
              <el-form-item label="活动名称" prop="title" required>
                <el-input v-model="ruleForm.title"></el-input>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item label="地址：" prop="addr" required>
                  <treeselect v-model="ruleForm.cityId" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择地址"/>
              </el-form-item>
            </el-col>

            <el-col :span="12">
              <el-form-item label="详细地址" prop="addrinfo" required>
                <el-input v-model="ruleForm.addrinfo"></el-input>
              </el-form-item>
            </el-col>
         
            <el-col :span="12">
              <el-form-item label="开始时间" prop="startTime" required>
                <el-date-picker
                    v-model="ruleForm.startTime"
                    type="date"
                    placeholder="开始时间">
                </el-date-picker>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="结束时间" prop="endTime" required>
                <el-date-picker
                    v-model="ruleForm.endTime"
                    type="date"
                    placeholder="开始时间">
                </el-date-picker>
              </el-form-item>
            </el-col>

            <el-col :span="24">
                <el-form-item
                  label="活动标签"
                  :rules="{required: true, message: '活动标签', trigger: 'change'}"
                >
                  <el-checkbox-group v-model="ruleForm.tag" style="text-align:left;">
                    <el-checkbox-button v-for="item in tagList" :key="item" :label="item">
                      {{ item }}
                    </el-checkbox-button>
                  </el-checkbox-group>                
                </el-form-item>
            </el-col>
            <el-col :span="24">
              <el-form-item label="简介" prop="desc">
                <el-input v-model="ruleForm.desc" type="textarea" class="org-release-desc"></el-input>
              </el-form-item>
            </el-col>
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
  apiGetOrganizationList,
  apiGetSiteConfig,
  apiOrgPublish,
  apiPostUploadFile
} from "../api";

  export default {
    name: 'userinfo',
    mounted(){
    },
    created() {
    },
    data() {
      return {
        ruleForm:{
            headImg: '',
            title: '',
            startTime: '',
            endTime: '',
            desc:'',
            tag: [],
            addr:''
        },
        tagList:['辩论赛','商赛','实习','夏校','讲座'],
        checkImg: true,
        rules: {
            title: [
            { required: true, message: "请输入名称", trigger: "blur" }
            ],
            startTime: [{ required: true, message: "请输入开始时间", trigger: "blur" }],
            endTime: [{ required: true, message: "请输入结束时间", trigger: "blur" }],
            desc: [{ required: true, message: "请输入官网简介", trigger: "blur" }],
            addr:[{ required: true, message: "请输入官网地址", trigger: "blur" }]
        },
        cityData: citys.citys
      }
    },
    computed: {
      uploadText(){
        if(this.ruleForm.headImg){
          return '重新上传'
        }
        return '选取文件'
      }
    },
    components: {
      Treeselect
    },
    methods: {
      imageChange(file) { 
        const isLt2M = file.size / 1024 / 1024 < 2;
        if (!isLt2M) {
          this.$message.error("上传活动图片大小不能超过 2MB!");
          this.checkImg = false
        } 
      },
      // 上传活动图片
      uploadTitleImg(event) {
        const file = event.file
        const param = new FormData() // 创建form对象
        param.append('file', file) // 通过append向form对象添加数据
        const config = {
          headers: {'Content-Type': 'multipart/form-data'}
        }
        if(this.checkImg){
          apiPostUploadFile(param, config).then(res => {
            if (res.data.code == 200) {
              this.ruleForm.headImg = res.data.data.file_path    
            }else{
              this.$message.error(res.data.msg);
            }
          })
        }
      },
      onSubmit(){
        let params = {
          userId: this.GLOBAL.userId,
          token: this.GLOBAL.token,
          headImg: this.ruleForm.headImg,
          startTime: this.ruleForm.startTime,
          endTime: this.ruleForm.endTime,
          desc: this.ruleForm.desc,
          cityId: this.ruleForm.cityId,
          addr: this.ruleForm.addr
        }
        this.$refs['ruleForm'].validate((valid) => {
            apiOrgPublish(params).then(res=>{
                if (res.data.code == 200) {
                    this.$message.success('发布成功');
                }else{
                    this.$message.error(res.data.msg);
                }
            })
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