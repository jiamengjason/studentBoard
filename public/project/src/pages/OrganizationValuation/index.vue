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
          <el-form ref="form" :model="sizeForm" label-width="150px">
            <!-- 总体评分 -->
            <el-form-item label="总体评分">
              <div class="st-rate">
                <el-rate
                  v-model="sizeForm.value"
                  :texts="['1分', '2分', '3分', '4分', '5分']"
                  :colors="['#F7BA2A', '#FF9900', '#FF7001']"
                  show-text>
                </el-rate>
              </div>
            </el-form-item>
            <!-- 推荐选择 -->
            <el-form-item label="推荐选择">
              是否会推荐给别的学生
              <el-radio-group v-model="sizeForm.radio2" size="medium">
                <el-radio-button label="yes"></el-radio-button>
                <el-radio-button label="no"></el-radio-button>
              </el-radio-group>
            </el-form-item>
            <!-- 选择标签 -->
            <el-form-item label="选择标签">
              <el-checkbox-group v-model="sizeForm.type">
                <el-checkbox-button label="积极反馈" name="type"></el-checkbox-button>
                <el-checkbox-button label="令人尊敬" name="type"></el-checkbox-button>
                <el-checkbox-button label="作业较多" name="type"></el-checkbox-button>
                <el-checkbox-button label="知识不足" name="type"></el-checkbox-button>
                <el-checkbox-button label="态度不佳" name="type"></el-checkbox-button>
                <el-checkbox-button label="回复及时" name="type"></el-checkbox-button>
                <el-checkbox-button label="关心学生" name="type"></el-checkbox-button>
                <el-checkbox-button label="死板无聊" name="type"></el-checkbox-button>
                <el-checkbox-button label="尽心尽力" name="type"></el-checkbox-button>
                <el-checkbox-button label="收费昂贵" name="type"></el-checkbox-button>
                <el-checkbox-button label="幽默风趣" name="type"></el-checkbox-button>
              </el-checkbox-group>
            </el-form-item>
            <!-- 详细评轮 -->
            <el-form-item label="详细评论">
              <el-input type="textarea" :autosize="{minRows: 6, maxRows: 8}" v-model="sizeForm.desc"></el-input>
            </el-form-item>
          </el-form>

          <el-button type="primary">提交评价</el-button>
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
      sizeForm: {
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
  margin-bottom: 140px;
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
    padding: 0 40px;
    width: 1100px;
    float: left;
    text-align: left;
    font-size: 24px;
    
    // 评分
    .st-rate{
      padding-top: 10px;
    }
    .el-button{
      margin-left: 150px;
      margin-top: 40px;
    }
  }
}
</style>