<template>
  <div class="base-personal">
    <TopTitle :text="text" />
    <div class="modify-base-info"></div>
  </div>
</template>
<script>
import TopTitle from "./TopTitle.vue";
export default {
  components: {
    TopTitle
  },
  data() {
    return {
      text: "修改绑定信息"
    };
  }
};
</script>
<style lang="scss">
@import "@/assets/base.scss";

.base-personal {
  margin-top: 40px;
  .modify-base-info {
    width: 1300px;
    height: 317px;
    background: #fff;
    padding: 50px;
    margin: 0;
    border: 1px solid red;
  }
}
</style>