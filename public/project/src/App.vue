<template>
  <div id="app" class="bg1">
    <!-- 头部 -->
    <Header></Header>
    <!-- banner -->
    <el-container>
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

