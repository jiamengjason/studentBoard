<template>
  <div class="organization-activety-list">
    <div class="activity-item">
      <img src="https://www.baidu.com/img/bd_logo1.png" alt />
      <div class="activity-item-bottom">
        <p class="title">高考冲刺</p>
        <p class="desc">desc</p>
        <div class="date-status">
          <p class="date">2019-10-0</p>
          <p class="status">进行中</p>
        </div>
      </div>
    </div>
    <div class="activity-item">
      <img src="https://www.baidu.com/img/bd_logo1.png" alt />
      <div class="activity-item-bottom">
        <p class="title">高考冲刺</p>
        <p class="desc">desc</p>
        <div class="date-status">
          <p class="date">2019-10-0</p>
          <p class="status active-status">进行中</p>
        </div>
      </div>
    </div>
    <div class="activity-item"></div>
    <div class="activity-item"></div>
  </div>
</template>
<script>
// import { apiGetOrgActiveList } from "@/apis/api";

export default {};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.organization-activety-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  .activity-item {
    height: 140px;
    border: 1px solid red;
    width: 690px;
    margin-bottom: 20px;
    padding: 20px;
    display: flex;
    img {
      width: 300px;
      height: 100px;
      margin-right: 20px;
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
    font-size: 18px;
    text-align: left;
    @include ignore();
    margin: 10px auto;
  }
  .status {
    width: 80px;
    height: 26px;
    line-height: 26px;
    background: rgba(204, 204, 204, 1);
    border-radius: 5px;
    color: #fff;
  }
  .active-status {
    background: $orangeColor;
  }
}
</style>