<template>
  <div class="jigou-item">
    <div class="img">
      <el-image
        style="width: 285px; height: 214px"
        :src="item.head_img ? item.head_img : '/img/avatar_teacher.png'"
        fit="contain"
      >
      </el-image>
    </div>
    <div class="con">
      <p>
        <span class="leftlabel">评分：</span>
        <span class="sore">{{ item.score  || '0.0' }}</span>
      </p>
      <p class="kcclass">
        <span class="leftlabel">机构：</span>
        <span>{{ item.organization_name  || '暂无' }}</span>
      </p>
      <p class="home-comment-label">
        <span class="leftlabel">评论：</span>
        <span>{{ item.comment  || '暂无' }}</span>
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
    width:285px;
    height:214px;
    background: #cccccc;
    img{
      border-radius:10px 10px 0px 0px;
      max-width: 100%;
      max-height: 100%;
    }
  } 
  .con{
    height: 130px;
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
        font-size:16px;
        font-weight:400;
        color:#333333;
      }       
      .leftlabel{
        color: #666666;
      }
      .sore{
        color:$orangeColor;
        font-size: 20px;
      }
    }
  }
}
  
</style>