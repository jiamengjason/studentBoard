<template>
  <div class="bg1">
    <!-- 头部 -->
    <Header></Header>
    <div class="container containerBgColor register">
      <router-link to="identity" active-class="activeClass">
        <div class="back el-icon-arrow-left">
        </div>
      </router-link>
      <div class="registerBox">
        <!-- <div class="register_logo">
          <router-link to="home" active-class="activeClass">
            <img src="../assets/img/logo.png" alt="">
          </router-link>
        </div> -->
        <div class="register-type">
          <!-- 学生注册 -->
          <regitsterS v-if="type == 'student'"></regitsterS>
          <regitsterT v-if="type == 'teacher'"></regitsterT>
          <regitsterP v-if="type == 'parent'"></regitsterP>
          <regitsterO v-if="type == 'organization'"></regitsterO>
        </div>
      </div>
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
</template>

<script>
  import Header from '../components/Header.vue'
  import Footer from '../components/Footer.vue'
  import regitsterS from '../components/regitsterS'
  import regitsterP from '../components/regitsterP'
  import regitsterO from '../components/regitsterO'
  import regitsterT from '../components/regitsterT'
  export default {
    name: 'login',
    data() {
      return {
        activeName: 'first',
        name: '',
        pwd: '',
        radio:'',
        type: this.$route.query.type
      }
    },
    mounted(){
      this.onSubmit()
    },
    components: {
      Header,
      Footer,
      regitsterS,
      regitsterO,
      regitsterT,
      regitsterP
    },
    methods: {
      onSubmit() {
        console.log('submit!', this.$route.query.type);
      }
    }
  }
</script>

<style lang="scss" scoped>
.register{
  padding: 0 0 50px 0;
  .back{
    margin: 60px 0 0 50px;
  }
  .register_logo{
    width: 300px;
    margin: 0px auto 30px auto;
    img{
      max-width: 100%;
    }
  }
}

.registerTagBox{
  max-width: 50%;
  margin: 20px auto;
}
</style>
