<template>
  <div class="home container containerBgColor">
    <div class="home-silider">
      <el-carousel height="300px">
        <el-carousel-item v-for="item in 4" :key="item">
          <h3 class="small">{{ item }}</h3>
        </el-carousel-item>
      </el-carousel>
    </div>

    <div class="homeTJ">
      <span>推荐</span>
      <span>关注</span>
    </div>
    <div class="homeTag">
      <el-tag type="success">近期活动<span class="el-icon-plus"></span></el-tag>
      <el-tag type="info">优惠<span class="el-icon-plus"></span></el-tag>
      <el-tag type="warning">资讯<span class="el-icon-plus"></span></el-tag>
      <el-tag type="danger">热点<span class="el-icon-plus"></span></el-tag>
      <el-tag type="info">干货分享<span class="el-icon-plus"></span></el-tag>
      <el-tag type="success">实习<span class="el-icon-plus"></span></el-tag>
      <el-tag type="info">经验<span class="el-icon-plus"></span></el-tag>
    </div>
    <div class="home-edu-list">
      <el-row :gutter="20">
        <el-col :span="12" v-for="(o, index) in 12" :key="index">
          <el-card class="box-card mt-20">
            <div slot="header" class="clearfix">
              <el-avatar icon="el-icon-user-solid"></el-avatar>
              <span class="home-edu-tit">XXX教育</span>
            </div>
            <div v-for="o in 2" :key="o" class="text item">
              <span v-if="index%2 ==0">{{'留学生XXXX ' + o }}</span>
              <span v-if="index%2 !=0">{{'新闻XXXX ' + o }}</span>
            </div>
          </el-card>  
        </el-col>
      </el-row>
    </div>

    <!-- 返回顶部 -->
    <div class="goTop" @click="goTop()">
      <span class="el-icon-arrow-up"></span>
    </div>
  </div>
</template>

<script>

export default {
  name: 'home',
  data() {
    return {
    }
  },
  mounted(){
  },
  components: {
  },
  methods: {
    goTop(){
      document.documentElement.scrollTop = 0
    }
  }
}
</script>

<style lang="scss">
  /*幻灯片*/
  .home-silider{
    padding: 20px 10px;
    .el-carousel__item {
      border-radius: 10px;
      h3{
        color: #475669;
        font-size: 14px;
        opacity: 0.75;
        line-height: 150px;
        margin: 0;
      }
    }

    .el-carousel__item:nth-child(2n) {
      background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
      background-color: #d3dce6;
    }
  }
  // 推荐
  .homeTJ{
    font-size: 18px;
    color: #666;
    font-weight: 400;
    text-align: center;
    margin: 10px 0 30px 0;
    span{
      margin: 0 20px;
    }
  }

  // tag
  .homeTag{
    text-align: center;
    .el-tag{
      margin: 10px 10px 0 10px;
    }
  }
  // list
  .home-edu-list{
    padding: 10px 10px 20px 10px;
    .clearfix{
      height: 40px;
      .el-avatar{
        float: left;
      }
      .home-edu-tit{
        float: left;
        display: block;
        height: 40px;
        line-height: 40px;
        margin-left: 20px;
      }
    }
  }

  .goTop{
    position: fixed;
    bottom: 30px;
    right: 20px;
    height: 30px;
    width: 30px;
    border-radius: 50%;
    background: #999999;
    color: #ffffff;
    font-size: 18px;
    line-height: 32px;
    text-align: center;
    &:hover{
      cursor: pointer;
    }
  }
  @media screen and (max-width: 750px) {
    .home-silider{
      .el-carousel__container{
        height: 200px!important;
      }
    }
    .el-menu-item{
      padding: 5px;
      margin-top: 5px;
      height: 20px;
      line-height: 20px;
    }
  }
</style>
