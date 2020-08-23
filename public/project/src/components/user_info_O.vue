<template>
  <div class="userInfo">
    <div class="top-title-warp">
        <span class="top-title-line"></span>
        <span class="top-title-text">基本信息</span>
    </div>
    <el-card class="box-card">
        <el-form ref="form" :model="userInfo" label-width="100px">
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
                <el-radio v-model="userInfo.type" label="1">中介</el-radio>
                <el-radio v-model="userInfo.type" label="2">培训</el-radio>
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
          </el-row>
          <el-row>
            <el-col :span="12">
              <el-form-item label="地址">
                <!-- <el-input v-model="form.name"></el-input> -->
                <treeselect v-model="userInfo.addres" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择地址"/>
              </el-form-item>
            </el-col>
            <el-col :span="12">
              <el-form-item label="详细地址">
                <el-input v-model="userInfo.addresInfo"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row>
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

  export default {
    name: 'userinfo',
    props: {
      userInfo: Object
    },
    mounted(){
    },
    data() {
      return {
        form: {
          name: 'XXXXXXX',
          textarea: ''
        },
        value:null,
        cityData: citys.citys
      }
    },
    components: {
      Treeselect
    },
    methods: {
      onSubmit() {
        console.log('submit!');
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