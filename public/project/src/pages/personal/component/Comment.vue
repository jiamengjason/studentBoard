<template>
  <div class="comment-list">
    <div v-for="(item,index) in list" :key="index" class="comment-item">
      <img src="https://www.baidu.com/img/bd_logo1.png" alt />
      <div class="activity-item-bottom">
        <div class="date-status">
          <p class="title">老师治学严谨，要求严格，能深入了解学生的学习和生活状况老师治学严谨，要求严格，能深入了解学生的学习和生活状况</p>
          <p class="date">2019-10-0</p>
        </div>
        <p class="desc">
          老师治学严谨，要求严格，能深入了解学生的学习和生活状况
          ，循循善诱，平易近人;注意启发和调动学生的积极性，课堂气氛较为活跃;上课例题丰富，
          不厌 其烦，细心讲解，使学生有所收获;半数认真工整，批改作业认真及时并注意讲解学生易犯错误;
          最重要的是，段老师能虚心并广泛听取学生的意见和反馈信息，
          做到及时修正和调整自己的教学。总之，段老师是一个不可多得的好教师。
        </p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data(){
    return {
      list:[1,2,3,4]
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.comment-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  padding-bottom:60px;
  background:#fff;
  .comment-item {
    height: 180px;
    border: 1px solid red;
    width: 100%;
    margin-bottom: 20px;
    padding: 20px;
    display: flex;
    img {
      width:180px;
      height:135px;
      border-radius:10px;
      margin-right:20px;
    }
  }
  .activity-item:nth-child(odd) {
    margin-right: 20px;
    border: 1px solid blue;
  }
  .activity-item-bottom {
    flex: 1;
  }
  .date-status {
    display: flex;
    color: rgba(0, 0, 0, 0.1);
    justify-content: space-between;
    font-size: 16px;
  }
  .title {
    font-size: 20px;
    color: rgba(51, 51, 51, 1);
    margin-bottom: 0;
    flex: 1;
    @include ignore();
  }
  .desc {
    color: rgba(153, 153, 153, 1);
    font-size: 16px;
    text-align: left;
    @include ignore(3);
    margin: 20px 0;
  }

  .date {
    font-size:14px;
    color: rgba(153, 153, 153, 1);
    margin-left:20px;
  }
}
</style>