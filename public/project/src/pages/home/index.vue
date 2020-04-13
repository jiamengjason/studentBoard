<template>
  <div class="layout">
    <Hearder></Hearder>
    
    <div id="dowebok">
      <!-- 首屏 -->
      <div class="section">
        <div class="section-con firstPage">
          <div class="st-banner">
            <!-- 搜索 -->
            <div class="st-search" id="conSearch">
              <el-input v-model="search" placeholder="请输入内容" class="input-with-select">
                <el-button slot="append" icon="el-icon-search" @click="goSearch"></el-button>
              </el-input>
            </div>
            
            <!-- nav -->
            <div class="st-nav">
              <el-row>
                <el-col :span="8" class="st-nav-jigou">
                  <router-link :to="{name: 'organization'}">&emsp;&emsp;著名机构</router-link>
                </el-col>
                <el-col :span="8" class="st-nav-jiaoshi">
                  <router-link :to="{name: 'teachers'}">&emsp;&emsp;知名教师</router-link>
                </el-col>
                <el-col :span="8" class="st-nav-quan">
                  <router-link :to="{name: 'home'}">&emsp;&emsp;留学圈</router-link>
                </el-col>
              </el-row>
            </div>
          </div>
        </div>
      </div>
      
      <!-- 第二屏 -->
      <div class="section">
        <div class="section-con secondPage">
          <div class="st-column-tit">著名机构</div> 
          <div class="st-column-con">
            <el-row :gutter="20">
              <el-col v-for="(item,index) in homeData.organization_list" :key="index" :span="6">
                <router-link :to="{name: 'organizationinfo', query:{organization_id: '3'}}">
                  <OrgList :item="item" />
                </router-link>
              </el-col>
            </el-row>
          </div>
          <div class="st-column-more">
            <router-link :to="{name: 'organization'}">点击查看更多</router-link>
          </div> 
        </div>
      </div>

      <!-- 第三屏 -->
      <div class="section">
        <div class="section-con thirdPage">
          <div class="st-column-tit">知名教师</div> 
          <div class="st-column-con">
            <el-row :gutter="20">
              <el-col
                v-for="(item,index) in homeData.teacher_list"
                :key="index"
                :span="6"
              >
                <router-link :to="{name: 'teachersinfo', query: {teacher_id: 17}}">
                  <TeachList :item="item" />
                </router-link>
              </el-col>
            </el-row>
          </div>
          <div class="st-column-more">
            <router-link :to="{name: 'teachers'}">点击查看更多</router-link>
          </div> 
        </div>
      </div>
      
      <!-- 第四屏 -->
      <div class="section">
        <div class="section-con fourthPage">
          <div class="st-column-tit">课外活动</div>
          <div class="st-column-con">
            <el-row :gutter="20">
              <router-link :to="{name: 'activityinfo', query: { 'active_id': 5 }}">
                <el-col v-for="(item,index) in homeData.active_list" :key="index" :span="12">
                  <ActiveList :item="item" />                  
                </el-col>
              </router-link>
            </el-row>
          </div>
          <div class="st-column-more">
            <router-link :to="{name: 'activity'}">点击查看更多</router-link>
          </div> 

          <Footer class="homefooter"></Footer>   
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import OrgList from "./components/OrgList";
import TeachList from "./components/TeachList";
import ActiveList from "./components/ActiveList";

import { apiHomeInfo } from "@/apis/api";

// import fullPage from "../assets/home.js"
export default {
  components: {
    Hearder,
    Footer,
    OrgList,
    TeachList,
    ActiveList
  },
  data() {
    return {
      search:'',
      homeData:{}
    }
  },
  created() {
    this.getHomeData()
  },
  methods: {
    getHomeData(){
      apiHomeInfo().then(res => {
        if(res.data.code == 200){
          this.homeData = res.data.data
        }else{
          this.$message.error('服务升级中，请稍后访问...');
        }
      })
    },
    goSearch(){
      this.$router.push({
        name: 'search',
        query:{
          searchText: this.search
        }
      })
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/assets/base.scss";

.el-input__inner {
  max-width: 100%!important;
}
.section-con{
  padding-top: 80px 0 0 0;
  width: 100%;
  height: 100%;
}
// 标题
.st-column-tit{
  width: 300px;
  font-size: 34px;
  height: 60px;
  font-weight: 500;
  color:rgba(51,51,51,1);
  margin: 75px auto 30px auto;
  position: relative;
  &::before{
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0;
    width: 60px;
    height: 6px;
    background:$orangeColor;
    border-radius: 4px;
    margin-left: -30px;
  }
}

.st-column-con{
  width: 1400px;
  margin: 0 auto;
}

.st-column-more{
  font-size:28px;
  font-weight:400;
  margin-top: 60px;
  a{
    display: inline-block;
    color:rgba(51,51,51,1);
    position: relative;
    height: 40px;
    line-height: 40px;
    padding-right: 50px;
    &::before{
      content: '';
      position: absolute;
      right: 0;
      top: 0;
      width: 40px;
      height: 40px;
      background: url(/img/home/more.png) no-repeat;
    }
  }
}
// 首屏
.firstPage{
 padding-bottom:55px; 
 .st-banner{
    width: 100%;
    min-height: 700px;
    background: url(/img/banner.jpg) no-repeat;
    height: 100%;
    position: relative;
    background-size: 100% 100%;
    // 搜索
    .st-search{
      width: 800px;
      padding-top: 170px;
      font-size:20px;
      font-weight:400;
      margin: 0 auto;
      color:rgba(153,153,153,1);
      
      .el-input__inner{
        max-width: 100%;
        height: 50px;
        line-height: 50px;;
      }
    }

    // 首屏 nav
    .st-nav{
      width: 1400px;
      height: 100px;
      line-height: 100px;
      position: absolute;
      left: 50%;
      bottom: -50px;
      margin-left: -700px;
      background: #ffffff;
      box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
      border-radius:10px;
      a{
        width: 100%;
        height: 100%;
        display: inline-block;
        position: relative;
        font-size:30px;
        font-weight:400;
        color:rgba(51,51,51,1);
        &::before{
          content: '';
          position: absolute;
          left: 135px;
          top: 0;
          width:60px;
          height:100px;
        }
      }
      // 著名机构
      .st-nav-jigou{
        a{
          &::before{
            background: url(/img/home/nav-jigou.png) 0 center no-repeat;
          }
        }
      }
      // 知名教师
      .st-nav-jiaoshi{
        position: relative;
        &::before{
          left: 0;
        }
        &::after{
          right: 0;
        }
        &::before,
        &::after{
          content: '';
          position: absolute;
          top: 20px;
          width:2px;
          height:60px;
          background:rgba(229,229,229,1);
        }
        a{
          &::before{
            background: url(/img/home/nav-jiaoshi.png) 0 center no-repeat;
          }
        }
      }
      // 留学圈
      .st-nav-quan{
        a{
          &::before{
            background: url(/img/home/nav-quan.png) 0 center no-repeat;
          }
        }
      }
    }
  }
}

// 第二屏

// 第三屏

// 第四屏
.fourthPage{
  position: relative;  
  .st-column-more{
    margin-bottom: 100px;
  }
}
</style>
<style lang="scss">
// 搜索
.st-search{
  .el-input-group{
    .el-input-group__append{
      cursor: pointer;
      background: none!important;
      background-color: transparent!important;
      border: none;
      position: absolute;
      right: 20px;
      top: 12px;
    }
  }
}
</style>