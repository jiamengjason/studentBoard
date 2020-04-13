<template>
  <div class="jigou-item">
    <div class="img">
      <el-image
        style="width: 335px; height: 252px"
        :src="item.head_img ? item.head_img : '/img/avatar_jigou.png'"
        fit="contain"
      >
      </el-image>
    </div>
    <div class="con">
      <p>
        <span class="leftlabel">评分：</span>
        <span class="sore">{{ item.score || '0.0' }} </span>
      </p>
      <p class="kcclass">
        <span class="leftlabel">业务：</span>
        <span
          v-for="(itemYewu,indexYewu) in item.organization_yewu"
          :key="indexYewu"
          style="margin-right:6px"
        >
          {{ itemYewu || '暂无' }}
        </span>
      </p>
      <p class="home-three-label">
        <span class="leftlabel">团队：</span>
        <span 
          v-for="(itemTeacher,indexTeacher) in item.teacher_list"
          :key="indexTeacher"
          style="margin-right:6px"
        >{{ itemTeacher.user_name || '暂无' }}</span>
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
    background: #cccccc;
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