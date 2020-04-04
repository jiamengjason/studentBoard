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
            <span>进入教育机构</span>
          </p>
          <p>
            <span class="leftlabel">团队：</span>
            <span>老师讲的特别棒，感觉自己进步很大，老师讲的特别棒，感觉自己进步很大，老师讲的特别棒，感...</span>
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
        return 5
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
  organization-list{
  width: 1400px;
  margin:  0 auto 50px auto;
  .jigou-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
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