<template>
  <div class="bg1">
    <Header></Header>
    <div class="container containerBgColor">
      <div class="identity">
        <div class="identity-tit">
          请选择您的身份：
        </div>
        <el-row :gutter="20" type="flex" justify="center">
          <!-- 学生 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'student'} } ">
              <img src="../assets/img/img_student.png" alt="" class="iimg">
              <p>我是学生</p> 
            </router-link>
          </el-col>
          <!-- 家长 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'parent'} } ">
              <img src="../assets/img/img_parent.png" alt="" class="iimg">
              <p>我是家长</p>
            </router-link>
          </el-col>
        </el-row>
        <el-row :gutter="20" type="flex" justify="center">
          <!-- 学生 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'teacher'} } ">
              <img src="../assets/img/img_teacher.png" alt="" class="iimg">
              <p>我是老师</p>
            </router-link>
          </el-col>
          <!-- 家长 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'organization'} } ">
              <img src="../assets/img/img_org.png" alt="" class="iimg">
              <p>我是机构</p>
            </router-link>
          </el-col>
        </el-row>
      </div>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

export default {
  name: "Home",
  components: {
    Header,
    Footer
  },
  data() {
    return {
      search:''
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
.st-container{
  padding-top: 60px;
}
.identity{
  margin-bottom: 60px;
  padding-bottom: 60px;
  color: #000000;
  a{
    color: #000000;
  }
  p{
    font-size: 16px;
    margin-bottom: 60px;
  }
  .identity-tit{
    text-align: left;
    font-size: 20px;
    padding: 40px 60px;
  }
  .el-image{
    border: 1px solid #ff7001;
    border-radius: 50%;
  }
  .iimg{
      width: 100px;
      height: 100px;
  }
  .el-col{
      text-align: center;
  }
}
</style>