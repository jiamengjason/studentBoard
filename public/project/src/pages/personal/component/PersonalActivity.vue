<template>
  <div class="personal-activety-list">
    <div class="activity-item">
      <img src="https://www.baidu.com/img/bd_logo1.png" alt />
      <div class="activity-item-bottom">
        <div class="title-status">
          <p class="title">高考冲刺</p>
          <p>进行中</p>
        </div>
        <p class="desc">desc</p>
      </div>
    </div>
    <div class="activity-item"></div>
    <div class="activity-item"></div>
    <div class="activity-item"></div>
  </div>
</template>
<script>
export default {};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.personal-activety-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  .activity-item {
    height: 340px;
    border: 1px solid red;
    width: 690px;
    margin-bottom: 20px;
    img {
      width: 100%;
      height: 230px;
    }
  }
  .activity-item:nth-child(odd) {
    margin-right: 20px;
    border: 1px solid blue;
  }
  .activity-item-bottom {
    padding: 20px;
  }
  .title-status {
    display: flex;
    justify-content: space-between;
  }
  .title {
    font-size: 28px;
    color: rgba(51, 51, 51, 1);
    margin-bottom: 0;
    flex: 1;
    @include ignore();
  }
  .desc {
    color: rgba(153, 153, 153, 1);
    font-size: 24px;
    text-align: left;
    @include ignore();
  }
}
</style>