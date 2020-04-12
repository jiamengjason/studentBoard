<template>
  <div class="jigou-item">
    <div class="img">
      <el-image v-if="item.head_img" :src="item.head_img" fit="fill"></el-image>
      <el-image v-else src="/img/home/jiaoshi.jpg" fit="fill"></el-image>
    </div>
    <div class="con">
      <p>
        <span class="leftlabel">评分：</span>
        <span class="sore">{{ item.score }}</span>
      </p>
      <p class="kcclass">
        <span class="leftlabel">机构：</span>
        <span>{{ item.organization_name }}</span>
      </p>
      <p class="home-comment-label">
        <span class="leftlabel">评论：</span>
        <span>{{ item.comment }}</span>
      </p>
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

.jigou-item{
  background:rgba(255,255,255,1);
  border-radius:10px;
  box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
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
    height: 192px;
    background:rgba(255,255,255,1);
    padding: 20px;
    border-radius:0px 0px 10px 10px;
    .kcclass,.home-three-label{
      @include ignore();
    }
    .home-comment-label{
      @include ignore(3);
    }
    p{
      text-align: left;
      line-height: 28px;
      margin: 0;
      span{
        font-size:18px;
        font-weight:400;
        color:#333333;
      }       
      .leftlabel{
        color: #666666;
      }
      .sore{
        color:$orangeColor;
        font-size: 26px;
      }
    }
  }
}
  
</style>