<template>
  <div class="huodong-item">
    <div class="img">
      <el-image v-if="item.title_img" :src="item.title_img" fit="fill"></el-image>
      <el-image v-else src="/img/home/huodong.jpg" fit="fill"></el-image>
    </div>
    <div class="con">
      <p class="tit">
        {{ item.title }}
        <span v-if="item.status == 1" class="ing">进行中</span>
        <span v-else-if="item.status == 2" class="end">未开始</span>
        <span v-else class="end">已结束</span>
      </p>
      <p class="desc">简介：{{ item.desc }}</p>
    </div>
  </div>
</template>
<script>
export default {
  props:{
    item:{
      type:Object
    }
  }
}
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.huodong-item{
  background:rgba(255,255,255,1);
  border-radius:10px;
  box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
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
      margin: 0;
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
      @include ignore();
    }
  }
}
  
</style>