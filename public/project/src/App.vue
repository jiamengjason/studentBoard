<template>
  <div id="app">
    <el-container>
    </el-container>
    <router-view/>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
  name: 'app',
  components: {
    Header,
    Footer
  }
}
</script>

<style scoped lang="scss">
  .el-header{
    height: 45px!important;
  }
</style>

