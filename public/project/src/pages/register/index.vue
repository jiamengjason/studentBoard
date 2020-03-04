<template>
  <div class="page-warp">
    <div class="register-page">
      <el-row>
        <el-col v-for="(item,index) in navList" :key="index" :span="6" :gutter="20">
          <div class="grid-content bg-purple">{{ item }}</div>
        </el-col>
      </el-row>
      <comStudentReg />
    </div>
  </div>
</template>
<script>
import comStudentReg from "./component/StudentReg";

export default {
  components: {
    comStudentReg
  },
  data() {
    return {
      navList: ["学生", "家长", "老师", "机构"]
    };
  }
};
</script>
<style lang="scss">
.page-warp {
  background: #f5f5f5;
}

.register-page {
  width: 1400px;
  height: 1000px;
  background: rgba(255, 255, 255, 1);
  margin: 20px auto 0;
}
</style>