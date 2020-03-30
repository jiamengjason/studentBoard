<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="organization-info">
      <!-- 面包屑 -->
      <div class="st-breadcrumb">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item>当前位置</el-breadcrumb-item>
          <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item>知名机构</el-breadcrumb-item>
          <el-breadcrumb-item>机构详细</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      
      <div class="st-org-con">
        <div class="part-1">
          <div class="avatar">
            <img src="/img/home/jigou.jpg" alt="">
          </div>
          <div class="con">
            <el-row :gutter="20">
              <el-col :span="6">
                <span class="name">视频教育机构</span>
                <span class="font1">4.7</span><span class="font2">/5</span>
              </el-col>
              <el-col :span="6">
                <span class="label">课程：</span>C4D/3Dmax
              </el-col>
              <el-col :span="6">
                <span class="label">网址：</span>shipin.com
              </el-col>
              <el-col :span="6">
                <button>评价视频教育机构</button>
              </el-col>
            </el-row>
            <div class="mess-tit">
              明星评价
              <span class="time">2020-03-15</span>  
            </div>
            <div class="mess-con">
              老师治学严谨，要求严格，能深入了解学生的学习和生活状况，循循善诱，平易近人;注意启发和调动学生的积极性，课堂气氛较为活跃;上课例题丰富，不厌其烦，细心讲解，使学生有所收获;半数认真工整，批改作业认真及时并注意讲解学生易犯错误;最重要的是，段老师能虚心并广泛听取学生的意见和反馈信息，做到及时修正和调整自己的教学。总之，段老师是一个不可多得的好教师。
            </div>
            <div class="st-message-zan">
              <span class="zan">10</span>  
              <span class="cai">2</span>  
            </div> 
          </div>
          <div style="clear:both"></div>
        </div>

        <!-- 名师团队 -->
        <div class="part-2">
          <div class="tit">名师团队</div>
          <div class="teacher-list">
            <div v-for="i in 8" :key="i" class="teacher-item">
              <div class="img">
                <img src="/img/home/jiaoshi.jpg" alt="">
              </div>
              <div class="name">
                胡伟<span class="font1">4.7</span><span class="font2">/5</span>
              </div>
            </div>
            <div style="clear:both"></div>
          </div>
        </div>
      </div>

      <!-- 全部评论 -->
      <div class="st-message">
        <div class="st-message-tit">
          全部评论  20
        </div>

        <div class="st-message-list">
          <div v-for="i in 12" :key="i" class="st-message-item">
            <!-- 头像 -->
            <div class="avatar">
              <img src="/img/avatar.jpg" alt="">
            </div>

            <!-- 评论内容 -->
            <div class="con">
              <div class="username">
                霉霉
                <span class="time">2020-03-15</span>  
              </div>
              老师治学严谨，要求严格，能深入了解学生的学习和生活状况，循循善诱，平易近人;注意启发和调动学生的积极性，课堂气氛较为活跃;上课例题丰富，不厌其烦，细心讲解，使学生有所收获;半数认真工整，批改作业认真及时并注意讲解学生易犯错误;最重要的是，段老师能虚心并广泛听取学生的意见和反馈信息，做到及时修正和调整自己的教学。总之，段老师是一个不可多得的好教师。
              <div class="st-message-zan">
                <span class="zan">10</span>  
                <span class="cai">2</span>  
              </div> 
            </div>
            <div style="clear:both"></div>
          </div>
        </div>

        <!-- 分页 -->
        <div class="st-page">
          <el-pagination background layout="prev, pager, next" :total="1000">
          </el-pagination>
        </div>
      </div>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:'',
      count:12
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
.organization-info{
  width: 1400px;
  margin:  80px auto 50px auto;
  // 面包屑
  .st-breadcrumb{
    padding: 20px 0;
  }
  
  // 公共部分-----------start
  // 分数
  .font1{
    font-size:28px;
    font-weight:bold;
    color:rgba(255,112,1,1);
  }
  .font2{
    font-size: 16px;
    color: #999999;
  }

  .time{
    float: right;
    font-size:16px;
    font-weight:400;
    color:rgba(153,153,153,1);
  }

  .st-message-zan{
    text-align: right;
    height: 20px;
    line-height: 20px;
    .zan,.cai{
      font-size:14px;
      font-weight:400;
      color:rgba(153,153,153,1);
      position: relative;
      margin-left: 40px;
      padding-left: 22px;
      display: inline-block;
      cursor: pointer;
      &::before{
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 16px;
        height: 100%;
      }
    }
    .zan{
      &::before{
        background: url(/img/zan.png) no-repeat 0 center;
      }
    }
    .cai{
      &::before{
        background: url(/img/cai.png) no-repeat 0 center;
      }
    }
  }
  // 公共部分----------end

  .st-org-con{
    background: #ffffff;
    text-align: left;
    .part-1{
      padding: 40px;
      .avatar{
        width: 210px;
        height: 210px;
        float: left;
        overflow: hidden;
        border-radius:10px;
        img{
          // max-width: 100%;
          max-height: 100%;
        }
      }
      .con{
        width: 1110px;
        float: left;
        padding-left: 40px;
        color: #333333;
        font-size: 24px;
        // 机构名称
        .name{
          font-size: 28px;
        }
       
        .label{
          font-size:24px;
          font-weight:400;
          color:#999999;
        }
        .mess-tit{
          font-size:20px;
          font-weight:400;
          color:rgba(51,51,51,1);
          padding: 20px 0;
        }
        .mess-con{
          font-size:16px;
          font-weight:400;
          color:rgba(153,153,153,1);
          line-height:30px;
        }
        button{
          float: right;
          width:210px;
          height:40px;
          border: none;
          line-height: 40px;
          background:rgba(255,112,1,1);
          border-radius:5px;
          font-size:22px;
          font-weight:400;
          color:rgba(255,255,255,1);
        }
      }
    }

    // 名师团队
    .part-2{
      padding: 0 40px;
      .tit{
        font-size:22px;
        font-weight:400;
        color:rgba(51,51,51,1);
        padding-bottom: 40px;
      }
      .teacher-list{
        margin-left: -40px;
        .teacher-item{
          float: left;
          padding-left: 40px;
          .img{
            width:120px;
            height:120px;
            border-radius:10px;
            overflow: hidden;
            img{
              // max-width: 100%;
              max-height: 100%;
            }
          }
          .name{
            text-align: center;
            font-size:28px;
            font-weight:500;
            color:rgba(51,51,51,1);
            padding: 20px 0 40px 0;
          }
        }
      }
    }
  }

  // 评论
  .st-message{
    margin-top: 40px;
    background: #ffffff;
    .st-message-tit{
      height: 100px;
      line-height: 100px;
      font-size:22px;
      font-weight:400;
      color:rgba(51,51,51,1);
      text-align: left;
      padding-left: 40px;
      border-bottom: 1px solid #cccccc;
    }

    // 评论列表
    .st-message-list{
      .st-message-item{
        border-bottom: 1px solid #cccccc;
        padding: 40px;
        // 头像
        .avatar{
          width: 80px;
          height: 80px;
          overflow: hidden;
          float: left;
          border-radius:50%;
          img{
            max-width: 100%;
          }
        }
        // 用户名
        .con{
          text-align: left;
          width: 1240px;
          padding-left: 40px;
          float: left;
          font-size:16px;
          font-weight:400;
          color:rgba(153,153,153,1);
          line-height:30px;
          .username{
            font-size:22px;
            font-weight:500;
            color:rgba(51,51,51,1);
            padding: 10px 0;
          }
        }
        
      }
    }
  }
}
</style>