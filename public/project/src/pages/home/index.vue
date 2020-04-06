<template>
  <div class="layout">
    <Hearder></Hearder>
    
    <div id="dowebok">
      <!-- 首屏 -->
      <div class="section">
        <div class="section-con firstPage">
          <div class="st-banner">
            <!-- 搜索 -->
            <div class="st-search">
              <el-input
                placeholder="请输入内容"
                suffix-icon="el-icon-search"
                :model="search"
              >
              </el-input>
              <!-- <el-input placeholder="请输入内容">
                <el-button slot="append" icon="el-icon-search"></el-button>
              </el-input> -->
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
              <el-col v-for="i in 4" :key="i" :span="6">
                <router-link :to="{name: 'organizationinfo', query:{organization_id: '3'}}">
                  <div class="jigou-item">
                    <div class="img">
                      <img src="/img/home/jigou.jpg" alt="">
                    </div>
                    <div class="con">
                      <p>
                        <span class="leftlabel">评分：</span>
                        <span class="sore">4.7</span>
                      </p>
                      <p class="kcclass">
                        <span class="leftlabel">课程：</span>
                        <span>电商类别</span>
                      </p>
                      <p>
                        <span class="leftlabel">团队：</span>
                        <span>孙老师 刘老师 王老师 </span>
                      </p>
                    </div>
                  </div>
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
              <el-col v-for="i in 4" :key="i" :span="6">
                <router-link :to="{name: 'teachersinfo', query: {teacher_id: 17}}">
                  <div class="jigou-item">
                    <div class="img">
                      <img src="/img/home/jiaoshi.jpg" alt="">
                    </div>
                    <div class="con">
                      <p>
                        <span class="leftlabel">评分：</span>
                        <span class="sore">4.7</span>
                      </p>
                      <p class="kcclass">
                        <span class="leftlabel">机构：</span>
                        <span>进入教育机构</span>
                      </p>
                      <p>
                        <span class="leftlabel">团队：</span>
                        <span>老师讲的特别棒，感觉自己进步很大，老师讲的特别棒，感觉自己进步很大，老师讲的特别棒，感...</span>
                      </p>
                    </div>
                  </div>
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
              <router-link :to="{name: 'activityinfo', query: { 'active_id': v.active_id }}">
                <el-col v-for="i in 2" :key="i" :span="12">
                  <div class="huodong-item">
                    <div class="img">
                      <img src="/img/home/huodong.jpg" alt="">
                    </div>
                    <div class="con">
                      <p class="tit">
                        基础插画公开课
                        <span class="ing">进行中</span>
                      </p>
                      <p class="desc">简介：零基础学习绘画技巧和色彩搭配</p>
                    </div>
                  </div>
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
// import fullPage from "../assets/home.js"
export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:''
    };
  },
  computed: {},
  mounted() {
    this.dowebok()
  },
  methods: {
    dowebok() {
      console.info('11111')
      // window.fullpage()
      // this.$router.go(0)
    }
  }
};
</script>

<style lang="scss" scoped>
@import "../../assets/jquery.fullPage.scss";
.el-input__inner {
  max-width: 100%!important;
}
.section-con{
  padding: 80px 0 0 0;
  width: 100%;
  height: 100%;
}
// 标题
.st-column-tit{
  width:300px;
  font-size:34px;
  height: 60px;
  font-weight:500;
  color:rgba(51,51,51,1);
  margin: 75px auto 30px auto;
  position: relative;
  &::before{
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0;
    width:60px;
    height:6px;
    background:rgba(255,112,1,1);
    border-radius:3px;
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
    background: url(/img/banner.jpg) no-repeat;
    height: 100%;
    position: relative;
    background-size: 100% 100%;
    // 搜索
    .st-search{
      width: 800px;
      padding-top: 100px;
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
.secondPage,.thirdPage{
  .jigou-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    // 图片
    .img{
      width:335px;
      height:252px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
    } 
    .con{
      background:rgba(255,255,255,1);
      padding: 20px;
      border-radius:0px 0px 10px 10px;
      p{
        text-align: left;
        line-height: 28px;
        span{
          font-size:18px;
          font-weight:400;
          color:#333333;
        }
        .leftlabel{
          color: #666666;
        }
        .sore{
          color:#ff7001;
          font-size: 26px;
        }
      }
    }
  }
}

// 第三屏
.thirdPage{
  .con{
    height: 192px;
  }
}

// 第四屏
.fourthPage{
  position: relative;
  .homefooter{
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;
  }
  .huodong-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    // 图片
    .img{
      width:690px;
      height:229px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
    } 
    .con{
      height: 110px;
      overflow: hidden;
      padding-top: 15px;
      p{
        text-align: left;
        height: 40px;
        line-height: 40px;
        overflow: hidden;
        padding: 0 20px;
      }
      .tit{
        font-size:28px;
        font-weight:400;
        color:rgba(51,51,51,1);
        position: relative;
        .ing{
          position: absolute;
          right: 0;
          top: 0;
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
          top: 0;
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
        font-size:24px;
        font-weight:400;
        color:rgba(153,153,153,1);
        line-height:48px;
      }
    }
  }
  
}
</style>