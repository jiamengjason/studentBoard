<template>
  <div class="org-release">
    <el-row :gutter="20" class="org-inner">
      <el-col :span="8">
        <div class="grid-content-img">
          <img src alt />
          <p class="content-first-desc">
            支持jpg、png格式的图片
            <br />文件须小于1M
          </p>
          <p class="content-first-btn">上传</p>
        </div>
      </el-col>
      <el-col :span="16">
        <el-form
          ref="ruleForm"
          :model="ruleForm"
          status-icon
          :rules="rules"
          label-width="100px"
          class="org-ruleForm"
        >
          <!-- 机构名称、简介 -->
          <el-row :gutter="20">
            <el-col :span="10">
              <el-form-item label="名称：" prop="title">
                <el-input v-model="ruleForm.title"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="8" :offset="4">
              <el-form-item label="简介：" prop="desc">
                <el-input v-model="ruleForm.desc" type="textarea" class="org-release-desc"></el-input>
              </el-form-item>
            </el-col>
          </el-row>         
          <el-row :gutter="10">
            <el-col :span="10" style="margin-top:-50px;">
              <el-form-item label="开始时间：" prop="startTime">
                <el-input v-model="ruleForm.startTime"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col :span="10">
              <el-form-item label="结束时间：" prop="endTime">
                <el-input v-model="ruleForm.endTime"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="10">
            <el-col :span="10">
              <el-form-item label="地址：" prop="addr">
                <el-input v-model="ruleForm.addr"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
     
          <div class="org-btn-warp">
            <p class="org-save-btn personal-btn">保存</p>
            <p class="org-cancel-btn personal-btn">取消</p>
          </div>
        </el-form>
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
  data(){
    return {
      titleImg: './update/xxx/xxxx/xxx/jpg',
      ruleForm:{
        title: '',
        startTime: '2020-03-20 00:00:00',
        endTime: '2020-03-20 00:00:00',
        desc:'',
        addr:''
      },
      rules: {
        title: [
          { required: true, message: "请输入名称", trigger: "blur" }
        ],
        startTime: [{ required: true, message: "请输入开始时间", trigger: "blur" }],
        endTime: [{ required: true, message: "请输入结束时间", trigger: "blur" }],
        desc: [{ required: true, message: "请输入官网简介", trigger: "blur" }],
        addr:[{ required: true, message: "请输入官网地址", trigger: "blur" }]
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";
.org-release{
   margin-top: 40px;
  .org-inner {
    width: 100%;
    max-width: 1400px;
    background: #fff;
    padding: 50px;
    margin: 0 !important;
  }
  .grid-content-img{
    img {
      display: block;
      width: 300px;
      height: 100px;
      border: 1px solid #d3dce6;
      margin: 0 auto;
    }
  }
  .org-ruleForm {
    margin: 0;
    .el-input__inner {
      width: 260px;
    }
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
  .org-btn-warp{
    display: flex;
    margin:50px auto 20px;
  }
  .org-release-desc{
    width: 260px;
    height: 300px;
    .el-textarea__inner{
      resize:none;
      padding: 20px;
    }
  }
  .personal-btn{
    width: 140px;
    height: 40px;
    border-radius: 5px;
    font-size: 20px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
  }
  .org-save-btn {
    background: $orangeColor;
    margin-right: 20px; 
  }
  .org-cancel-btn{
    background: #ccc;
  }
}
</style>