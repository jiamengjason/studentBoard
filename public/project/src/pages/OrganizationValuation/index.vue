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
          <el-breadcrumb-item>机构评价</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      
      <div class="valuation">
        <div class="valuation-l">
          <img src="/img/home/jigou.jpg" alt="">
        </div>
        <div class="valuation-r">
          <el-form ref="form" :model="form" label-width="80px">
            <!-- 总体评分 -->
            <el-form-item label="总体评分">
              <el-input :model="form.name"></el-input>
            </el-form-item>
            <!-- 推荐选择 -->
            <el-form-item label="推荐选择">
              <el-input :model="form.name"></el-input>
            </el-form-item>
            <!-- 选择标签 -->
            <el-form-item label="选择标签">
              <el-checkbox-group :model="form.type">
                <el-checkbox-button label="积极反馈1" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈2" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈3" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈4" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈5" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈6" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈7" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈8" name="type"></el-checkbox-button>
                <el-checkbox-button label="积极反馈9" name="type"></el-checkbox-button>
              </el-checkbox-group>
            </el-form-item>
            <!-- 详细评轮 -->
            <el-form-item label="详细评论">
              <el-input type="textarea" :model="form.desc"></el-input>
            </el-form-item>
          </el-form>
        </div>
        <div style="clear:both"></div>
      </div>
      <div style="clear:both"></div>
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
      count:12,
      form: {
        type:[]
      },
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
.valuation{
  background: #ffffff;
  padding: 40px;
  .valuation-l{
    float: left;
    width: 210px;
    height: 210px;
    border-radius:10px;
    overflow: hidden;
    img{
      max-height: 100%;
    }
  }
  .valuation-r{
    float: right;
    text-align: left;
  }
}
</style>