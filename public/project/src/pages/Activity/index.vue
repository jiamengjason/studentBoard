<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <SearchBar></SearchBar>
    <div class="organization-list">
      <el-row :gutter="20">
        <el-col v-for="i in count" :key="i" :span="12">
          <div class="huodong-item">
            <div class="img">
              <img src="/img/home/huodong.jpg" alt="">
            </div>
            <div class="con">
              <p class="tit">
                基础插画公开课
                <span class="ing">进行中</span>
              </p>
              <p class="desc">简介：零基础学习绘画技巧和色彩搭配</p>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import SearchBar from "../../components/SearchBar";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer,
    SearchBar
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
.organization-list{
  width: 1400px;
  margin:  0 auto 50px auto;
  .huodong-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    // 图片
    .img{
      width:690px;
      height:229px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
    } 
    .con{
      height: 110px;
      overflow: hidden;
      padding-top: 15px;
      p{
        text-align: left;
        height: 40px;
        line-height: 40px;
        overflow: hidden;
        padding: 0 20px;
      }
      .tit{
        font-size:28px;
        font-weight:400;
        color:rgba(51,51,51,1);
        position: relative;
        .ing{
          position: absolute;
          right: 0;
          top: 0;
          width: 99px;
          height: 32px;
          line-height: 32px;
          background: url(/img/home/ing-bg.png) no-repeat;
          font-size:18px;
          color:rgba(255,255,255,1);
          text-align: center;
        }
        .end{
          position: absolute;
          right: 0;
          top: 0;
          width: 99px;
          height: 32px;
          line-height: 32px;
          background: url(/img/home/end-bg.png) no-repeat;
          font-size:18px;
          color:rgba(255,255,255,1);
          text-align: center;
        }
      }
      
      .desc{
        font-size:24px;
        font-weight:400;
        color:rgba(153,153,153,1);
        line-height:48px;
      }
    }
  }
}
</style>