<template>
  <div class="userInfo">
    <div class="top-title-warp">
        <span class="top-title-line"></span>
        <span class="top-title-text">发布活动</span>
    </div>
    <el-card class="box-card">
        <el-form ref="form" :model="ruleForm" label-width="100px">
          <el-row>
            <el-col :span="24">
              <el-form-item label="活动名称" required>
                <el-input v-model="ruleForm.title"></el-input>
              </el-form-item>
            </el-col>
          
            <el-col :span="12">
              <el-form-item label="地址：" prop="addr" required>
                  <treeselect v-model="ruleForm.addres" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择地址"/>
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
  apiOrgPublish
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
            titleImg: './update/xxx/xxxx/xxx/jpg',
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
    components: {
      Treeselect
    },
    methods: {
      onSubmit(){
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