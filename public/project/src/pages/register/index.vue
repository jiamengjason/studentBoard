<template>
  <div class="page-warp">
    <Hearder />
    <div class="st-container">
      <Breadcrumb class="bread-crumb" :bread-list="breadList" />
      <div class="register-page">
        <el-tabs v-model="activeName" :stretch="stretch" @tab-click="handleClick">
          <el-tab-pane
            v-for="(item,index) in navList"
            :key="index"
            :label="item.lable"
            :name="item.name"
          >
            {{ item }}
          </el-tab-pane>
        </el-tabs>

        <OrgReg v-if="activeName == 'organization'" />
        <TeacherReg v-if="activeName == 'teacher'" />
        <StudentReg v-if="activeName == 'student'" />
        <ParentReg v-if="activeName == 'parent'" />     
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import Hearder from "@/components/Hearder";
import Footer from "@/components/Footer";
import Breadcrumb from "@/components/Breadcrumb";
import StudentReg from "./component/Student";
import TeacherReg from "./component/Teacher";
import ParentReg from "./component/Parent";
import OrgReg from "./component/Organization";


import { ROLE_LIST } from "@/constants/index"

export default {
  components: {
    Hearder,
    Footer,
    Breadcrumb,
    StudentReg,
    TeacherReg,
    ParentReg,
    OrgReg
  },
  data() {
    console.log(ROLE_LIST,'ROLE_LIST')
    return {
      activeName: 'student',
      stretch: true,
      navList: ROLE_LIST
    };
  },
  computed: {
    breadList(){
      if(this.activeName == 'parent'){
      return ['个人注册','家长']

      }else if(this.activeName == 'teacher'){
      return ['个人注册','老师']

      }else if(this.activeName == 'organization'){
      return ['个人注册','机构']
      }
      return ['个人注册','学生']
    }
  },
  methods: {
    handleClick(tab) {
      this.activeName = tab.name;
    }
  }
};
</script>
<style lang="scss" scoped>
.page-warp {
  background: #f5f5f5;
}
.bread-crumb{
  margin:80px auto 0;
}
.tab-warp {
  .grid-content {
    font-size: 22px;
    font-weight: 600;
  }
}
.tab-item {
  padding-bottom: 30px;
  border-bottom: 1px solid #ccc;
}
.register-page {
  width: 1200px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 140px;
  padding-top: 30px;
}
</style>