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
            <el-image
              style="width: 210px; height: 210px"
              :src="orgInfo.head_img ? orgInfo.head_img : '/img/avatar_jigou.png'"
              fit="contain"
            >
            </el-image>
          </div>
          <div class="con">
            <el-row :gutter="20">
              <el-col :span="6">
                <span class="name">{{ orgInfo.organization_name }} </span>
                <span class="font1"> {{ orgInfo.avg_score ? orgInfo.avg_score : '0' }}</span><span class="font2">/5</span>
              </el-col>
              <el-col :span="6">
                <span class="label">业务：</span>{{ orgInfo.organization_yewu ? orgInfo.organization_yewu : '未填写' }}
              </el-col>
              <el-col :span="6">
                <span class="label">网址：</span>{{ orgInfo.organization_www ? orgInfo.organization_www : '未填写' }}
              </el-col>
              <el-col :span="6">
                <span @click="orgvaluation" class="orgvaluation-a">
                  评价机构
                </span>
              </el-col>
            </el-row>
            <div class="mess-tit">
              明星评价
              <span class="time">{{ starComment.create_time }}</span>  
            </div>
            <div class="mess-con">
              {{ starComment.comment || '评论内容为空' }}
            </div>
            <div class="st-message-zan">
              <span class="zan" @click="doLikeDisList(starComment.comment_id, 'like')">{{ starComment.give_like }}</span>  
              <span class="cai" @click="doLikeDisList(starComment.comment_id, 'dislike')">{{ starComment.give_dislike }}</span>  
            </div> 
          </div>
          <div style="clear:both"></div>
        </div>

        <!-- 名师团队 -->
        <div class="part-2">
          <div class="tit">名师团队</div>
          <div class="teacher-list">
            <!-- 有数据 -->
            <div v-for="v in famousTeacher" :key="v.teacher_id" :if="famousTeacher.length == 0" class="teacher-item">
              <div class="img">
                <el-image
                  style="width: 120; height: 120px"
                  :src="v.head_img ? v.head_img : '/img/avatar_teacher.png'"
                  fit="contain"
                >
                </el-image>
              </div>
              <div class="name">
                {{ v.user_name }}<span class="font1">{{ v.score ? v.score : '0' }}</span><span class="font2">/5</span>
              </div>
            </div>
            <!-- 无数据 -->
            <div :if="famousTeacher.length == 0" class="teacher-item">
              <div class="img">
                <el-image
                  style="width: 120px; height: 120px"
                  src="/img/avatar_teacher.png"
                  fit="contain"
                >
                </el-image>
              </div>
              <div class="name">
                <span class="font2">暂无</span>
              </div>
            </div>
            <div style="clear:both"></div>
          </div>
        </div>
      </div>

      <!-- 全部评论 -->
      <div class="st-message">
        <div class="st-message-tit">
          全部评论  {{pageConfig.total_num}}
        </div>

        <div class="st-message-list">
          <div v-if="commentList.length == 0" class="nullCon">
            暂无评论内容
          </div>
          <div v-for="(v, i) in commentList" :key="i" :if="commentList.length > 0" class="st-message-item">
            <!-- 头像 -->
            <div class="avatar">
              <el-image
                style="width: 80px; height: 80px"
                :src="v.head_img ? v.head_img : '/img/avatar_student.png'"
                fit="contain"
              >
              </el-image>
            </div>

            <!-- 评论内容 -->
            <div class="con">
              <div class="username">
                {{ v.user_name }}
                <span class="time">{{ v.create_time }}</span>  
              </div>
              {{ v.comment ? v.comment : '内容为空' }}
              <div class="st-message-zan">
                <span class="zan" @click="doLikeDisList(v.comment_id, 'like')">{{ v.give_like ? v.give_like : 0 }}</span>  
                <span class="cai" @click="doLikeDisList(v.comment_id, 'dislike')">{{ v.give_dislike ? v.give_dislike : 0 }}</span>  
              </div> 
            </div>
            <div style="clear:both"></div>
          </div>
        </div>

        <!-- 分页 -->
        <div v-if="commentList.length > 0" class="st-page">
          <el-pagination 
            background
            :page-size="pageConfig.page_size"
            :current-page.sync="pageConfig.page"
            layout="prev, pager, next"
            :total="pageConfig.total_num"
          >
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
import { apiGetOrganizationInfo, apiGetFamousTeacher, apiGetCommentListOrg, apiDoLikeDislike, apiGetOrgStartComment } from "@/apis/api_st";


export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:'',
      count:12,
      orgInfo: {},
      // 机构老师
      famousTeacher: [],
      pageConfig:{
        page: 1,
        page_size: 20,
        total_num: 0
      },
      // 全部评论
      commentList: [],
      // 明星评价
      starComment: {}
    };
  },
  computed: {},
  mounted() {
    // 获取机构详细信息
    this.getInfo()
    // 获取明星评价
    this.getStarCom()
    // 获取机构名师团队
    this.getFamousTeacher()
    // 获取全部评论
    this.getCommentList()
  },
  methods: {
    getInfo(){
      // 获取机构详细信息
      apiGetOrganizationInfo({'organization_id': this.$route.query.organization_id}).then(res => {
        console.info('res', res)
        if(res.data.code==200){
          this.orgInfo = res.data.data
        }else{
          this.orgInfo = {}
        }
      })
    },
    getStarCom(){
      // 获取明星评价
      apiGetOrgStartComment({
        'organization_id': this.$route.query.organization_id
      }).then( res => {
        if(res.data.code==200){
          this.starComment = res.data.data
        }else{
          this.starComment = {}
        }
      })
    },
    getFamousTeacher(){
      // 获取机构名师团队
      apiGetFamousTeacher({'organization_id': this.$route.query.organization_id}).then(res => {
        console.info('res', res)
        if(res.data.code==200){
          this.famousTeacher = res.data.data
        }else{
          this.famousTeacher = []
        }
      })
    },
    getCommentList(){
      // 获取全部评论
      apiGetCommentListOrg({
        'organization_id': this.$route.query.organization_id,
        'page': this.pageConfig.page,
        'page_size': this.pageConfig.page_size,
      }).then(res => {
        if(res.data.code==200){
          this.commentList = res.data.data.list
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
        }else{
          this.commentList = []
        }
      })
    },
    orgvaluation(){
      if(localStorage.getItem('board_user_id')){
        this.$router.push({
          name: 'orgvaluation', 
          query: {
            evaluated_uid: this.orgInfo.organization_id, 
            head_img: this.orgInfo.head_img
          }
        })
      }else{
        this.$message.error('请登录后，再来评价吧。');
      }
    },
    doLikeDisList(comment_id, type){
      if(!comment_id || !type) return
      // 点赞、踩
      apiDoLikeDislike({
        'comment_id': comment_id,
        'type': type
      }).then( res => {
        if(res.data.code==200){
          this.$message.success('成功');
        }else{
          this.$message.error(res.data.msg);
        }
      })
    }
  }
};
</script>

<style lang="scss" scoped>
.organization-info{
  width: 1400px;
  margin:  80px auto 50px auto;
  
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
        text-align: center;
        display: flex;
        align-items: center;
        img{
          // max-width: 100%;
          max-height: 100%;
          align-items: center;
        }
      }
      .con{
        width: 1070px;
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
        .orgvaluation-a{
          cursor: pointer;
          display: block;
          text-align: center;
          float: right;
          height:40px;
          padding: 0 40px;
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
          width: 1200px;
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