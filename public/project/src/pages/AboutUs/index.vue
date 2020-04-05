<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="st-container mt80">
      <!-- banner -->
      <div style="height:40px"></div> 
      <div class="st-aboutus-banner">
        <img src="/img/banner_aboutUs.jpg" alt="">
      </div>
      <!-- 关于 -->
      <div class="st-about-desc">
        <div class="part1">
          <div class="st-about-img">
            <img src="/img/aboutUs.jpg" alt="">
          </div>
          <div class="st-about-con">
            <p class="tit">关于学汇网</p>
            <p>学汇网（www.xuehuiwang.cn）隶属于北京某某某有限公司，汇聚全国众多知名教师和著名机构，打造便捷的一站式学习平台。</p>
            <p>解决国内各类学习参差不齐问题的设计网站。 抱着高端优质学习的宗旨，让每一个学生都能
            够学到好知识学的起好知识。</p>
            <p>网站目前已有四千多学习类目，目前网站已包含绘画、金融、销售、管理等学科。</p>
          </div>
          <div style="clear:both"></div>
        </div>

        <!-- 团队介绍 -->
        <div class="st-tit">团队介绍</div> 
        <div class="st-team">
          <el-row :gutter="20">
          <el-col :span="8"><div class="grid-content bg-purple"></div></el-col>
          <el-col :span="8"><div class="grid-content bg-purple"></div></el-col>
          <el-col :span="8"><div class="grid-content bg-purple"></div></el-col>
        </el-row>
        </div>

        <!-- 免责声明 -->
        <div class="st-tit">免责声明</div> 
        <div class="st-Liability">
          <p>studentboard由北京陟遐科技控股集团有限公司运营，涉及具体产品服务的，将由有资质的服务商提供。如果用户（“用户”或“您”）
  在本网站访问、预定或使用studentboard的产品或服务（以上统称为“服务”），便视为用户接受了以下免责说明，请您仔细阅读以下
  内容。如果您不同意以下任何内容，请立刻停止访问/使用本网站所提供的相关服务。</p>
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
      search:''
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
// banner
.st-aboutus-banner{
  margin:0 0 40px 0;
  height:500px;
  border-radius:10px;
  overflow: hidden;
  img{
    max-height: 100%;
  }
}

// 关于
.st-about-desc{
  background: #ffffff;
  padding: 40px;
  margin-bottom: 140px;
  text-align: left;
  // 第一部分
  .part1{
    .st-about-img{
      width:400px;
      height:400px;
      border-radius:10px;
      overflow: hidden;
      float: left;
      img{
        max-height: 100%;
      }
    }
    .st-about-con{
      width: 885px;
      float: left;
      padding: 0 40px;
      p{
        font-size:22px;
        font-weight:400;
        color:rgba(102,102,102,1);
        line-height:48px;
        margin-top: 30px;
        &.tit{
          color:rgba(51,51,51,1);
          font-size: 32px;
          margin-top: 10px;
        }
      }
    }
  }
  // 标题
  .st-tit{
    font-size:32px;
    font-weight:400;
    color:rgba(51,51,51,1);
    margin: 40px 0;
  }

  // 团队介绍
  .st-team{
    .bg-purple {
      background: #d3dce6;
    }
    .grid-content {
      border-radius: 4px;
      min-height: 320px;
    }
  }

  // 免责声明
  .st-Liability{
    p{
      font-size:22px;
      font-weight:400;
      color:rgba(102,102,102,1);
      line-height:48px;
      margin-bottom: 20px;
    }
  }
}
</style>