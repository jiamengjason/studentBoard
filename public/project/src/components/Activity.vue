<template>
  <el-row :gutter="20">
    <el-col v-for="(item,index) in actList" :key="index" :span="6" class="sort">
      <div class="jigou-item">
        <div class="img">
          <img src="/img/home/jiaoshi.jpg" alt="">
        </div>
        <div class="con">
          <p>
            <span class="leftlabel">评分：</span>
            <span class="sore">4.7</span>
          </p>
          <p class="kcclass">
            <span class="leftlabel">机构：</span>
            <span class="right-org">进入教育机构</span>
          </p>
          <p>
            <span class="leftlabel">团队：</span>
            <span class="right-team">老师讲的特别棒，感觉自己进步很大...</span>
          </p>
        </div>
      </div>
    </el-col>
  </el-row>
</template>
<script>
export default {
  props:{
    actList:{
      type:Array,
      default(){
        return [1,2,34,5,5]
      }
    }
  },
  data(){
    return {

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
  margin-bottom: 20px;
  height: 432px;
  // 图片
  .img{
    width:334px;
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
      display: flex;
      margin: 0;
      span{
        font-size:16px;
        font-weight:400;
        color:#333333;
      }
      .leftlabel{
        color: #666666;
        width: 60px;
      }
      .right-org{
        flex: 1;
        @include ignore();
      }
      .right-team{
        flex: 1;
        @include ignore(3);
      }
      
      .sore{
        color:$orangeColor;
        font-size: 20px;
      }
    }
  }
}

</style>