<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="st-container mt80">
      <!-- 面包屑 -->
      <div class="st-breadcrumb">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item>当前位置</el-breadcrumb-item>
          <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item>知名机构</el-breadcrumb-item>
          <el-breadcrumb-item>机构详细</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      
      <div class="valuation">
        <div class="valuation-l">
          <img src="/img/jigou.jpg" alt="">
        </div>
        <div class="valuation-r">
          ddd
        </div>
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
      search:'',
      count:12
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
.valuation{
  .valuation-l{
    float: left;
    width: 210px;
    height: 210px;
    border-radius:10px;
  }
  .valuation-r{
    float: right;
  }
}
</style>