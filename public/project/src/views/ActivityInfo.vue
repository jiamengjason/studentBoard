<template>
  <div class="bg3">
    <!-- 头部 -->
    <Header></Header>
    <div class="activityInfo container containerBgColor">
      <el-row type="flex" class="row-bg" justify="center">
        <el-col :span="5">
          <div class="activityInfo-banner">
            <router-link to="activity" active-class="activeClass">
              <div class="back el-icon-arrow-left">
              </div>
            </router-link>
            <el-image
              style="width: 100%; height: 300px;"
              src="sdsd"
              fit="cover">
              <div slot="placeholder" class="image-slot">
              加载中<span class="dot">...</span>
              </div>
            </el-image>
            <div class="tag">
              <el-tag type="success">辩论赛</span></el-tag>
              <el-tag type="info">商赛</el-tag>
            </div>
          </div>
        </el-col>
        <el-col :span="9">
          <div class="activityInfo-con">
            <p class="tit-name">XXXX活动/比赛</p>
            <p class="tit-juban">举办方：XXX</p>
            <p class="tit-time">时间：2020年07月31号</p>
            <p class="tit-addres">地点：XXX</p>
            <p class="tit-people">报名人数：XXX 人</p>
            <p class="desc-teacher">简介：简单文案文案文案简单文案文案文案XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX s</p>
            <div class="status">
              <el-button type="danger" plain>进行中</el-button>
            </div>
          </div>
        </el-col>
        <el-col :span="8">
          <div class="activityInfo-desc">
            <p>这里是详细介绍，这里是详细介绍，这里是详细介绍，这里是详细介绍，这里是详细介绍，这里是详细介绍，这里是详细介绍，吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦吧啦</p>
          </div>
          <div class="btns">
            <el-button round>官网</el-button>
            <el-button round>报名</el-button>
          </div>
        </el-col>
      </el-row>
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
  
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
export default {
  name: 'find',
  data() {
    const generateData = _ => {
        const list = [];
        for (let i = 1; i <= 15; i++) {
            var item = {
                type:'1',
                key: i,
                show: true,
                desc: `简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介 ${ i }`,
            }
            list.push(item);
        }
        return list;
    };
    return {
      activeName: 'first',
      list: generateData()
    }
  },
  mounted(){
  },
  components: {
    Header,
    Footer
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    },
    format(percentage) {
      return percentage === 100 ? '${percentage}分' : `${percentage}分`;
    }
  }
}
</script>

<style lang="scss" scoped>
.activityInfo{
  padding: 20px;
  .row-bg{
    background: rgba(210,224,240,1);
    padding: 70px 0;
    border-radius: 20px;
  }
  .activityInfo-banner,
  .activityInfo-con{
    font-size: 14px;
  }
  .activityInfo-banner{
    .back{
      position: absolute;
      left: 20px;
      top: 20px;
    }
    .tag{
        width: 100%;
        text-align: center;
        padding:10px 10px 0 10px;
        span{
          margin: 0 5px;
        }
      }
  }

  // 中间描述部分
  .activityInfo-con{
    margin: 0 20px;
    padding: 0 20px;
    position: relative;
    height: 340px;
    border-left: 1px solid rgb(163,175,192);
    border-right: 1px solid rgb(163,175,192);
    .tit-name{
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .tit-juban{
      font-size: 16px;
      margin-bottom: 10px;
    }
    .tit-time{
      font-size: 14px;
      color: #666666;
    }
    .tit-addres{
      font-weight: 14px;
      line-height: 25px;
    }
    .status{
      position: absolute;
      bottom: -5px;
      right: 20px;
    }
  }
  
  .activityInfo-desc{
    height: 300px;
    p{
      font-size: 14px;
      line-height: 25px;
    }
  }
  .btns{
    text-align: right;
    padding-top: 5px;
  }
}
</style>
