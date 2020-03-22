<template>
  <div class="page-warp">
    <div class="personal-top-com">
      <div class="top-img">
        <div class="personal-top-info">
          <p class="top-head-img"></p>
          <p class="top-name">name</p>
          <p class="top-mobile">手机号</p>
        </div>
      </div>
    </div>
    <div class="personal-page">
      <el-tabs v-model="activeName" :stretch="stretch" class="tab-pane" @tab-click="handleClick">
        <el-tab-pane
          v-for="(item,index) in navList"
          :key="index"
          :label="item.name"
          :name="item.key"
        >{{ item }}</el-tab-pane>
      </el-tabs>
      <StudentPersonal v-if="role ===1 " :active-name="activeName" />
      <TeacherPersonal v-if="role ===2 " />
    </div>
  </div>
</template>
<script>
import StudentPersonal from "./component/StudentPersonal";
import TeacherPersonal from "./component/TeacherPersonal";

import { PERSONAL_NAV_LIST } from "@/constants/index";
export default {
  components: {
    StudentPersonal,
    TeacherPersonal
  },
  data() {
    return {
      activeName: "student1",
      stretch: true,
      role: 1 // 1 student 2 teacher 3 parent 4 organization
    };
  },
  computed: {
    navList() {
      return PERSONAL_NAV_LIST[this.role];
    }
  },
  methods: {
    handleClick(tab) {
      console.log(tab.name, tab);
      this.activeName = tab.name;
    }
  }
};
</script>
<style lang="scss">
@import "@/assets/base.scss";
.page-warp {
  background: #f5f5f5;
}
// 顶部样式
.personal-top-com {
  width: 100%;
  max-width: 1400px;
  height: 426px;
  background: #fff;
  margin: 0 auto;
  .top-img {
    position: relative;
    width: 100%;
    height: 180px;
    background: $orangeColor;
    .personal-top-info {
      position: absolute;
      top: 74px;
      left: 50%;
      margin-left: -90px;
    }
    .top-head-img {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      background: #fff;
    }
    .top-name {
      font-size: 28px;
      color: rgba(51, 51, 51, 1);
    }
    .top-mobile {
      margin-top: 20px;
      font-size: 22px;
      color: rgba(102, 102, 102, 1);
    }
  }
}

// 选项卡样式
.tab-warp {
  .grid-content {
    font-size: 22px;
    font-weight: 600;
  }
}
.tab-item {
  padding-bottom: 30px;
  border-bottom: 1px solid #ccc;
}
.personal-page {
  width: 100%;
  max-width: 1400px;
  height: 1000px;
  margin: 6px auto 0;
  .el-tabs__header {
    margin-bottom: 0;
  }
  .el-tabs__item {
    height: 80px;
    line-height: 80px;
  }
}
.tab-pane {
  background: #fff;
}
</style>