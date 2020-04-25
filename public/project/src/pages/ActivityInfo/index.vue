<template>
  <div class="layout mainBg mt80">
    <Hearder></Hearder>
    <!-- 面包屑 -->
    <div class="st-container st-container">
      <div class="st-breadcrumb">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item>当前位置</el-breadcrumb-item>
          <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item>知名机构</el-breadcrumb-item>
          <el-breadcrumb-item>机构详细</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      <!-- banner -->
      <div class="st-activity-banner">
        <!-- <img src="/img/banner_activity.jpg" alt=""> -->
        <el-image
          style="width: 1200px; height: 429px"
          :src="activityInfo.head_img ? activityInfo.head_img : ''"
          fit="contain"
        >
          <div slot="error" class="el-image__error">
            <i class="el-icon-picture-outline"></i>
          </div>
        </el-image>
      </div>

      <!-- 机构详情 -->
      <div class="st-activity-info">
        <div class="inner-l">
          <el-image
            style="width: 285px; height: 214px"
            :src="activityInfo.head_img ? activityInfo.head_img : '/img/avatar_jigou.png'"
            fit="contain"
          >
          </el-image>
        </div>
        <div class="inner-r">
          <div class="tit">
            <span>【{{ activityInfo.title }}】</span>
            <span class="jigou">绘画教育机构</span>
            <span class="time">{{ activityInfo.create_time }}</span>
          </div>
          <div class="address">
            活动地址：{{ activityInfo.addr }}
          </div>
          <div class="address">
            开始时间：{{ activityInfo.start_time }}
          </div>
          <div class="address">
            结束时间：{{ activityInfo.end_time }}
          </div>
          <div class="desc">
            {{ activityInfo.desc }}
          </div>
          <div class="apply" v-if="activityInfo.status != 3">
            <button v-if="!activityInfo.is_attend">报名</button>
            <button v-if="activityInfo.is_attend">已报名</button>
            <button v-if="activityInfo.is_attend" class="cancle">取消</button>
          </div>
          <div class="apply" v-if="activityInfo.status == 3">
            <button class="cancle">已结束</button>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>

      <!-- titi -->
      <div class="st-activity-tit">
        其他活动
      </div>
      <!-- 其他活动 -->
      <div class="organization-list">
        <el-row v-if="activeList.length > 0" :gutter="20">
          <el-col v-for="(v,i) in activeList" :key="i" :span="12">
            <router-link :to="{ name: 'activityinfo', query: { 'active_id': v.active_id }}">
              <div class="huodong-item">
                <div class="img">
                  <el-image
                    style="width: 590px; height: 202px"
                    :src="v.head_img ? v.head_img : ''"
                    fit="contain"
                  >
                    <div slot="error" class="el-image__error">
                      <i class="el-icon-picture-outline"></i>
                    </div>
                  </el-image>
                </div>
                <div class="con">
                  <p class="tit">
                    {{ v.title }}
                    <span v-if="v.status == 1" class="ing">进行中</span>
                    <span v-if="v.status == 2" class="end">未开始</span>
                    <span v-if="v.status == 3" class="end">已结束</span>
                  </p>
                  <p class="desc">简介：{{ v.desc }}</p>
                </div>
              </div>
            </router-link>
          </el-col>
        </el-row>

        <div v-if="activeList.length == 0" class="nullCon">暂其他活动内容</div> 
      </div>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import { apiGetActiveInfo, apiGetActiveList } from "@/apis/api_st";


export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      activityInfo: {},
      activeList: []
    };
  },
  computed: {},
  mounted() {
    // 获取活动详情
    this.getActiveInfo()
    // 获取其他活动列表
    this.getActiveList()
  },
  methods: {
    getActiveInfo(){
      apiGetActiveInfo({
        active_id: this.$route.query.active_id,
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token')
      }).then( res => {
        if(res.data.code==200){
          this.activityInfo = res.data.data
          // if(this.activityInfo.start_time) this.activityInfo.start_time = this.activityInfo.start_time.substring(0, 10)
          // if(this.activityInfo.end_time) this.activityInfo.end_time = this.activityInfo.end_time.substring(0, 10)
        }else{
          this.activityInfo = {}
        }
      })
    },
    // 获取活动列表
    getActiveList(){
      apiGetActiveList({
        'page': 1,
        'page_size': '10',
        'type': 2
      }).then( res => {
        if(res.data.code==200){
          this.activeList = res.data.data.list
        }else{
          this.activeList = {}
        }
      })
    }
  }
};
</script>

<style lang="scss" scoped>
.organization-list{
  margin:  0 auto 50px auto;
  .huodong-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    // 图片
    .img{
      width:590px;
      height:202px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
    } 
    .con{
      height: 85px;
      overflow: hidden;
      padding-top: 10px;
      p{
        text-align: left;
        height: 40px;
        line-height: 40px;
        overflow: hidden;
        padding: 0 20px;
        margin: 0;
      }
      .tit{
        font-size:22px;
        font-weight:400;
        color:rgba(51,51,51,1);
        position: relative;
        .ing{
          position: absolute;
          right: 0;
          top: 5px;
          width: 99px;
          height: 32px;
          line-height: 32px;
          background: url(/img/home/ing-bg.png) no-repeat;
          font-size:18px;
          color:rgba(255,255,255,1);
          text-align: center;
        }
        .end{
          position: absolute;
          right: 0;
          top: 5px;
          width: 99px;
          height: 32px;
          line-height: 32px;
          background: url(/img/home/end-bg.png) no-repeat;
          font-size:18px;
          color:rgba(255,255,255,1);
          text-align: center;
        }
      }
      
      .desc{
        font-size:18px;
        font-weight:400;
        color:rgba(153,153,153,1);
        line-height:35px;
      }
    }
  }
}
// banner
.st-activity-banner{
  height:500px;
  border-radius:10px;
  overflow: hidden;
  img{
    max-height: 100%;
  }
}
// 活动详情
.st-activity-info{
  background: #ffffff;
  margin-top: 40px;
  padding: 40px;
  .inner-l{
    width: 285px;
    height: 214px;
    border-radius:10px;
    float: left;
    overflow: hidden;
  }
  .inner-r{
    width: 795px;
    float: left;
    margin-left: 40px;
    text-align: left;
    // 标题
    .tit{
      margin-top: 15px;
      font-size:22px;
      color:rgba(51,51,51,1);
      .jigou,
      .time{
        font-size: 14px;
        color:rgba(102,102,102,1);
      }
      .time{
        float: right;
      }
    }
    // 地址
    .address{
      font-size:16px;
      font-weight:400;
      color:rgba(51,51,51,1);
      margin-top: 15px;
    }
    .desc{
      font-size:14px;
      font-weight:400;
      color:rgba(153,153,153,1);
      line-height:30px;
      margin-top: 15px;
    }
    .apply{
      margin-top: 15px;
      button{
        height: 46px;
        line-height: 46px;
        padding: 0 40px;
        background:rgba(255,112,1,1);
        border-radius:5px;
        margin-right: 40px;
        color: #ffffff;
        font-size:26px;
        font-weight:400;
        color:rgba(255,255,255,1);
        border: none;
        &.cancle{
          background:rgba(204,204,204,1);
        }
      }
    }
  }
}
// 标题
.st-activity-tit{
  text-align: left;
  padding:  40px 0;
  font-size:16px;
  color:rgba(51,51,51,1);
}
</style>