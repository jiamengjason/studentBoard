<template>
  <div class="top-title-warp">
    <span class="top-title-line"></span>
    <span class="top-title-text">{{ text }}</span>
  </div>
</template>
<script>
export default {
  props: {
    text: {
      type: String,
      default: ""
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.top-title-warp {
  width: 1400px;
  height: 100px;
  background: #fff;
  line-height: 100px;
  border-bottom: 2px solid #e4e7ed;
  text-align: left;
  .top-title-line {
    width: 4px;
    height: 21px;
    background: $orangeColor;
    display: inline-block;
    margin: 0 10px 0 40px;
  }
  .top-title-text {
    font-size: 22px;
    color: $orangeColor;
  }
}
</style>