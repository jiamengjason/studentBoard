<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <SearchBar></SearchBar>
    <div class="organization-list">
      <el-row :gutter="20">
        <el-col v-for="i in count" :key="i" :span="6" class="sort">
          <div class="jigou-item">
            <div class="img">
              <img src="/img/home/jigou.jpg" alt="">
            </div>
            <div class="con">
              <p>
                <span class="leftlabel">评分：</span>
                <span class="sore">4.7</span>
              </p>
              <p class="kcclass">
                <span class="leftlabel">课程：</span>
                <span>电商类别</span>
              </p>
              <p>
                <span class="leftlabel">团队：</span>
                <span>孙老师 刘老师 王老师 </span>
              </p>
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
  .jigou-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    // 图片
    .img{
      width:335px;
      height:252px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
    } 
    .con{
      background:rgba(255,255,255,1);
      padding: 20px;
      border-radius:0px 0px 10px 10px;
      p{
        text-align: left;
        line-height: 28px;
        span{
          font-size:18px;
          font-weight:400;
          color:#333333;
        }
        .leftlabel{
          color: #666666;
        }
        .sore{
          color:#ff7001;
          font-size: 26px;
        }
      }
    }
  }
}
</style>