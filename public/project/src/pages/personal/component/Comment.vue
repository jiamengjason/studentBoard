<template>
  <div class="comment-list">
    <template v-if="commentList.length > 0">
      <div v-for="(item,index) in commentList" :key="index" class="comment-item">
        <template v-if="item.role_id === '1'">
          <img :src="item.head_img" alt />
          <div class="activity-item-bottom">
            <div class="date-status">
              <p class="title">{{ item.organization_name }}</p>
              <p class="date">{{ item.comment_time }}</p>
            </div>
            <p class="desc">{{ item.comment }}</p>
          </div>
        </template>
        <template v-else-if="item.role_id === '2'">
          <img :src="item.head_img" alt />
          <div class="activity-item-bottom">
            <div class="date-status">
              <p class="title">{{ item.organization_name }} | {{ item.teacher_name }}</p>
              <p class="date">{{ item.comment_time }}</p>
            </div>
            <p class="desc">{{ item.comment }}</p>
          </div>
        </template>
      </div>
      <!-- 分页 -->
      <div class="st-page">
        <el-pagination 
          background
          :page-size="pageConfig.pageSize"
          :current-page.sync="pageConfig.page"
          layout="prev, pager, next"
          :total="pageConfig.totalNum"
        >
        </el-pagination>
      </div>
    </template>
    <p v-else class="personal-empty-list">暂无数据</p>
  </div>
</template>
<script>
import { apiGetMyCommentList } from "@/apis/api";

export default {
  data(){
    return {
      commentList:[],
      pageConfig:{
        page: 1,
        pageSize: 20,
        totalNum: 0
      }
    }
  },
  computed: {},
  created(){
    this.getMyComment()
  },
  methods:{
    getMyComment(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        // userId: 5,
        // token: '8743ca12de24675423788eb080cb11d5',
        page: this.pageConfig.page,
        page_size: this.pageConfig.pageSize
      }
      apiGetMyCommentList(params).then(res=>{
        if (res.data.code == 200) {
          this.commentList = res.data.data.list;
        }else{
          this.$message.error(res.data.msg);
        }
      })
    }
  }
};
</script>
<style lang="scss" scoped>
@import "@/assets/base.scss";

.comment-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  padding-bottom:60px;
  background:#fff;
  .comment-item {
    height: 180px;
    border: 1px solid red;
    width: 100%;
    margin-bottom: 20px;
    padding: 20px;
    display: flex;
    img {
      width:180px;
      height:136px;
      border-radius:10px;
      margin-right:20px;
    }
  }
  .activity-item:nth-child(odd) {
    margin-right: 20px;
    border: 1px solid blue;
  }
  .activity-item-bottom {
    flex: 1;
  }
  .date-status {
    display: flex;
    color: rgba(0, 0, 0, 0.1);
    justify-content: space-between;
    font-size: 16px;
  }
  .title {
    font-size: 20px;
    color: rgba(51, 51, 51, 1);
    margin-bottom: 0;
    flex: 1;
    @include ignore();
  }
  .desc {
    color: rgba(153, 153, 153, 1);
    font-size: 16px;
    text-align: left;
    @include ignore(3);
    margin: 20px 0;
  }

  .date {
    font-size:14px;
    color: rgba(153, 153, 153, 1);
    margin-left:20px;
  }
  .st-page {
    margin: 0 auto;
  }
}
</style>