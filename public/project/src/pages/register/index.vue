<template>
  <div class="page-warp">
    <div class="register-page">
      <el-tabs v-model="activeName" :stretch="stretch" @tab-click="handleClick">
        <el-tab-pane
          v-for="(item,index) in navList"
          :key="index"
          :label="item.name"
          :name="item.key"
        >{{ item }}</el-tab-pane>
      </el-tabs>
      <comStudentReg v-if="activeName == 'student'" />
      <comParentReg v-if="activeName == 'parent'" />
      <comTeacherReg v-if="activeName == 'teacher'" />
      <comOrgReg v-if="activeName == 'organization'" />
    </div>
  </div>
</template>
<script>
import comStudentReg from "./component/Student";
import comTeacherReg from "./component/Teacher";
import comParentReg from "./component/Parent";
import comOrgReg from "./component/Organization";
export default {
  components: {
    comStudentReg,
    comTeacherReg,
    comParentReg,
    comOrgReg
  },
  data() {
    return {
      activeName: "student",
      stretch: true,
      navList: [
        { name: "学生", key: "student" },
        { name: "家长", key: "parent" },
        { name: "老师", key: "teacher" },
        { name: "机构", key: "organization" }
      ]
    };
  },
  methods: {
    handleClick(tab) {
      console.log(tab.name, tab);
      this.activeName = tab.name;
      // console.log(tab, event, 111);
    }
  }
};
</script>
<style lang="scss">
$orangeColor: #ff7001; //主题色
.page-warp {
  background: #f5f5f5;
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
  width: 1400px;
  height: 1000px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 0;
}
</style>