<template>
  <el-row :gutter="26">
    <el-col :span="7" class="logo">
      <el-breadcrumb separator-class="el-icon-arrow-right" class="breadcrumb">
        <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
        <el-breadcrumb-item v-for="(item,index) in breadList" :key="index">{{ item }}</el-breadcrumb-item>
      </el-breadcrumb>
    </el-col>
  </el-row>
</template>
<script>
export default {
  props: {
    breadList: {
      type: Array
    }
  }
};
</script>
<style scoped>
.breadcrumb {
  /* width: 1400px; */
  margin: 0 auto;
  padding-top: 20px;
}
.bread-crumb{
  margin: 80px auto 0!important;
}
</style>