<template>
  <div id="app">
    <el-container>
      <el-header>
        <!-- 头部 -->
        <Header></Header>
      </el-header>
      <!-- banner -->
      
    </el-container>
    <router-view/>
    <!-- 尾部 -->
    <Footer></Footer>
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

