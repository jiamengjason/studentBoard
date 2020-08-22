<template>
  <div class="activity bg3">
    <!-- 头部 -->
    <Header></Header>
    <div class="activity container containerBgColor">

      <!-- 教师 -->
        <div class="activity-list">
          <div class="find-paixu" style="width:568px;">
            <span class="mlr" :class="{'hover': type=='0'}" @click="changeSearType('0')">智能排序</span>
            <span class="mlr" :class="{'hover': type=='1'}" @click="changeSearType('1')">预告</span>
            <span class="mlr" :class="{'hover': type=='2'}" @click="changeSearType('2')">进行中</span>
            <span class="mlr" :class="{'hover': type=='3'}" @click="changeSearType('3')">已结束</span>
            <!-- 位置 -->
            <div class="mlr" style="width:200px;display:inline-block;">
              <treeselect v-model="value" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择位置"/>
            </div>
          </div>
          <div style="clear:both"></div>
          <div class="findTag">
            <el-tag type="success">辩论赛<span class="el-icon-plus"></span></el-tag>
            <el-tag type="info">商赛<span class="el-icon-plus"></span></el-tag>
            <el-tag type="warning">实习<span class="el-icon-plus"></span></el-tag>
            <el-tag type="danger">夏校<span class="el-icon-plus"></span></el-tag>
            <el-tag type="info">讲座<span class="el-icon-plus"></span></el-tag>
          </div>

          <el-row :gutter="50">
            <el-col :span="8" v-for="(o, index) in activeList" :key="index">
              <el-card :body-style="{ padding: '0px'}">
                  <div class="activity-item" @mouseover="changeTransitionFlag(index,false)" @mouseleave="changeTransitionFlag(index,true)">
                    <div class="activity-item-desc"  v-show="o.show1" key="box1">
                      <router-link to="activityinfo" active-class="activeClass">
                        <p class="tit-name">{{o.title}}</p>
                        <p class="tit-juban">举办方：{{o.organization_name}}</p>
                        <p class="tit-time">时间：{{o.start_time}}</p>
                        <p class="tit-time"><span style="width:3em; display: inline-block;"></span>{{o.end_time}}</p>
                        <p class="tit-addres">地点：{{o.addr}}</p>
                        <p class="desc-teacher">简介：{{o.desc}}</p>
                        <div class="status">
                          <el-button type="danger" plain>进行中</el-button>
                        </div>
                      </router-link>
                    </div>
                    <!-- banner 淡入淡出效果 -->
                     <el-collapse-transition >
                      <div v-show="o.show" style="position:relative" key="box2">
                          <div class="activity-item-banner">
                            <el-image
                                style="width: 100%; height: 365px;"
                                src="111"
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
                    </el-collapse-transition>
                    
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
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import {apiGetActiveList} from '../api'
import citys from '../assets/data/citys.js'

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
                show1: false,
                desc: `简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介 ${ i }`,
            }
            list.push(item);
        }
        return list;
    };
    return {
      load: false,
      activeName: 'first',
      list: generateData(),
      activeList: [],
      pageConfig:{
        page: 1,
        page_size: 20,
        total_num: 0
      },
      type: '',
      value: null,
      cityData: citys.citys
    }
  },
  mounted() {
    // 获取活动列表
    this.getActiveList()
  },
  components: {
    Header,
    Footer,
    Treeselect
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    },
    format(percentage) {
      return percentage === 100 ? '${percentage}分' : `${percentage}分`;
    },
    changeTransitionFlag(index, flag){
      this.activeList[index].show = flag
      this.$set(this.activeList, index, this.activeList[index])
      if(flag){
        this.activeList[index].show1 = !flag
        this.$set(this.activeList, index, this.activeList[index])
      }else{
        let _this = this
        setTimeout(function(){
          _this.activeList[index].show1 = !flag
          _this.$set(_this.activeList, index, _this.activeList[index])
        }, 300)
      }
      
    },
    changeSearType(value){
      this.type = value
      if(value || value == 0){
        this.getActiveList()
      }
    },
    // 获取活动列表
    getActiveList(){
      apiGetActiveList({
        'title': this.title,
        'page': this.pageConfig.page,
        'page_size': this.pageConfig.page_size,
        'type': this.type
      }).then( res => {
        if(res.data.code==200){
          this.activeList = res.data.data.list
          this.activeList.forEach(item =>{
            item.show = true
            item.show1 = false
          })
          this.load = true
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
        }else{
          this.activeList = {}
        }
      })
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
    width: 100%;
    height: 365px;
    a{
      color: #333333;
    }
    .activity-item-banner{
      width: 100%;
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
      position: relative;
      height: 365px;
      z-index: 0;
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
