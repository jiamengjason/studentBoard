<template>
  <div class="activity bg3">
    <!-- 头部 -->
    <Header></Header>
    <div class="activity container containerBgColor">

      <!-- 教师 -->
        <div class="activity-list">
          <div class="find-paixu">
            <span class="mlr">智能排序</span>
            <span class="mlr">评分</span>
            <el-dropdown :hide-on-click="false" class="mlr">
              <span class="el-dropdown-link">
                位置<i class="el-icon-caret-bottom el-icon--right"></i>
              </span>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item>位置1</el-dropdown-item>
                <el-dropdown-item>位置2</el-dropdown-item>
                <el-dropdown-item>位置3</el-dropdown-item>
                <el-dropdown-item>位置4</el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </div>
          <div class="findTag">
            <el-tag type="success">辩论赛<span class="el-icon-plus"></span></el-tag>
            <el-tag type="info">商赛<span class="el-icon-plus"></span></el-tag>
            <el-tag type="warning">实习<span class="el-icon-plus"></span></el-tag>
            <el-tag type="danger">夏校<span class="el-icon-plus"></span></el-tag>
            <el-tag type="info">讲座<span class="el-icon-plus"></span></el-tag>
          </div>

          <el-row :gutter="50">
            <el-col :span="8" v-for="(o, index) in list" :key="index">
              <el-card :body-style="{ padding: '0px'}">
                  <div class="activity-item" @mouseover="o.show = false" @mouseleave="o.show = true">
                    <div class="activity-item-desc"  v-show="!o.show" >
                      <router-link to="activityinfo" active-class="activeClass">
                        <p class="tit-name">XXXX活动/比赛</p>
                        <p class="tit-juban">举办方：XXX</p>
                        <p class="tit-time">时间：2020年07月31号</p>
                        <p class="tit-addres">地点：XXX</p>
                        <p class="desc-teacher">简介：简单文案文案文案简单文案文案文案XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX s</p>
                        <div class="status">
                          <el-button type="danger" plain>进行中</el-button>
                        </div>
                      </router-link>
                    </div>
                    <!-- banner 淡入淡出效果 -->
                    <transition name="el-zoom-in-top">
                      <div v-show="o.show" class="transition-box">
                          <div class="activity-item-banner">
                            <el-image
                                style="width: 100%; height: 300px;"
                                src="sdsd"
                                fit="cover">
                                <div slot="placeholder" class="image-slot">
                                加载中<span class="dot">...</span>
                                </div>
                            </el-image>
                            <div class="tag">
                              <el-tag type="success">辩论赛</span></el-tag>
                              <el-tag type="info">商赛</el-tag>
                            </div>
                          </div>
                      </div>
                      </transition>
                    
                  </div>
                  
              </el-card>
            </el-col>
          </el-row>
        </div>
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
  
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
export default {
  name: 'find',
  data() {
    const generateData = _ => {
        const list = [];
        for (let i = 1; i <= 15; i++) {
            var item = {
                type:'1',
                key: i,
                show: true,
                desc: `简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介 ${ i }`,
            }
            list.push(item);
        }
        return list;
    };
    return {
      activeName: 'first',
      list: generateData()
    }
  },
  mounted(){
  },
  components: {
    Header,
    Footer
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    },
    format(percentage) {
      return percentage === 100 ? '${percentage}分' : `${percentage}分`;
    }
  }
}
</script>

<style lang="scss">
// 列表内容
.activity-list{
  padding: 20px 100px;
  .el-col{
    margin-bottom: 20px;
    &:last-child{
      margin-bottom: 0;
    }
  }
  .tit-name{
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  .tit-juban{
    font-size: 16px;
    margin-bottom: 10px;
  }
  .tit-time{
    font-size: 14px;
    color: #666666;
  }
  .tit-addres{
    font-weight: 14px;
    line-height: 25px;
  }
  .desc-teacher{
    font-size: 14px;
    color: #666666;
  }

    
  .activity-item{
    position: relative;
    width: 100%;
    height: 300px;
    a{
      color: #333333;
    }
    .activity-item-banner{
      width: 100%;
      position:absolute;
      left: 0;
      top: 0;
      z-index: 0;
      .tag{
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        padding:10px;
        span{
          margin: 0 5px;
        }
      }
    }
    .activity-item-desc{
      font-size: 14px;
      padding: 20px;
      .status{
        position: absolute;
        bottom: 10px;
        right: 20px;
      }
    }
    .el-card{
      margin-bottom: 50px;
    }
  }
}
</style>
