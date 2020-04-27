<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="st-container mt80">
      <div class="identity">
        <div class="identity-tit">
          请选择您的身份：
        </div>
        <el-row :gutter="20" type="flex" justify="center">
          <!-- 学生 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'student'} } ">
              <el-image
                style="width: 100px; height: 100px"
                src="/img/img_student.png"
                fit="contain"
              >
              </el-image>
              <p>我是学生</p> 
            </router-link>
          </el-col>
          <!-- 家长 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'parent'} } ">
              <el-image
                style="width: 100px; height: 100px"
                src="/img/img_parent.png"
                fit="contain"
              >
              </el-image>
              <p>我是家长</p>
            </router-link>
          </el-col>
        </el-row>
        <el-row :gutter="20" type="flex" justify="center">
          <!-- 学生 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'teacher'} } ">
              <el-image
                style="width: 100px; height: 100px"
                src="/img/img_teacher.png"
                fit="contain"
              >
              </el-image>
              <p>我是老师</p>
            </router-link>
          </el-col>
          <!-- 家长 -->
          <el-col :span="8">
            <router-link :to="{ name:'register', query: {type: 'organization'} } ">
              <el-image
                style="width: 100px; height: 100px"
                src="/img/img_org.png"
                fit="contain"
              >
              </el-image>
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
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";

export default {
  name: "Home",
  components: {
    Hearder,
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
  background: #ffffff;
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
}
</style>