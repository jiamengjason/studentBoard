<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div style="height:40px"></div>
    <div class="st-container mt80">
      <!-- banner -->
      <div class="banner">
        <el-image
          style="width: 1200px; height: 429px"
          src="/img/banner_studyCircle.jpg"
          fit="contain"
        >
        </el-image>
        <!-- <img src="/img/banner_studyCircle.jpg" alt=""> -->
      </div>

      <div class="q-list">
        <div class="q-tit">
          <router-link :to="{name: 'studyCircle', query:{ type: 'all'}}">全部</router-link>
          <router-link :to="{name: 'studyCircle', query:{ type: 'hot'}}">热门问题</router-link>
          <router-link class="hover" :to="{name: 'question'}">提个问题</router-link>
          <!-- <router-link :to="{name: 'studyCircle'}">回答问题</router-link> -->
        </div>
        
        <div class="quest">
          <el-row :gutter="20">
            <el-col :span="3">
              <!-- 头像 -->
              <el-image
                style="width: 80px; height: 80px"
                :src="userInfo.head_img ? userInfo.head_img : '/img/avatar_student.png'"
                fit="contain"
              >
              </el-image>
            </el-col>
            <el-col :span="18">
              <el-input placeholder="写下你的问题，准确的描述问题更容易得到解答" v-model="comment" type="textarea" :autosize="{minRows: 6, maxRows: 8}" show-word-limit maxlength="500"></el-input>
              <el-button type="primary" plain>提问</el-button>
            </el-col>
          </el-row>
        </div>
      </div>
    </div> 
    
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import { apiQaList } from "@/apis/api_st";


export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:'',
      isLogin: localStorage.getItem('board_user_id'),
      userInfo: {},
      comment: ''
    };
  },
  computed: {},
  mounted() {
    this.getLoginUser()
  },
  methods: {
    // 获取用户信息
    getLoginUser(){
      if(localStorage.getItem('board_user_id')){ 
        apiGetUserInfo({
          userId: localStorage.getItem('board_user_id'),
          token: localStorage.getItem('board_token')
        }).then( res => {
          if(res.data.code == '200'){
            this.userInfo = res.data.data
            this.isLogin = true
          }else{
            this.isLogin = false
          }
        })
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.q-tit{
  border-bottom: 1px solid #cccccc;
  font-size:18px;
  font-weight:400;
  color:rgba(51,51,51,1);
  height: 65px;
  line-height: 65px;
  a{
    padding: 0 40px;
    color:rgba(51,51,51,1);
    &:hover{
      color:rgba(255,112,1,1);
    }
    &.hover{
      color:rgba(255,112,1,1);
    }
  }
}
.q-list{
  text-align: left;
  margin: 40px 0 100px 0;
  background: #ffffff;

  .q-item{
    padding: 25px 30px;
    font-size:14px;
    line-height: 30px;
    font-weight:400;
    color:rgba(51,51,51,1);
    border-bottom: 1px solid #cccccc;
    p{
      margin: 0;
    }
    .st-message-zan{
      margin-top: 10px;
    }
  }
}
.quest{
  padding: 40px 100px;
  .el-button{
    margin-top: 40px;
  }
}
</style>