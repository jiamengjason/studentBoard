<template>
  <div class="organization-activety-list">
    <template v-if="orgActiveList.length > 0">
      <div v-for="(item,index) in orgActiveList" :key="index" class="activity-item">
        <img :src="item.title_img" alt />
        <div class="activity-item-bottom">
          <p class="title">{{ item.title }}</p>
          <p class="desc">{{ item.desc }}</p>
          <div class="date-status">
            <p class="date">{{ item.start_time - item.end_time }}</p>
            <p class="status">{{ state(item.status) }}</p>
          </div>
        </div>
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
import { apiGetOrgActiveList } from "@/apis/api";

export default {
  data(){
    return {
      orgActiveList:[],
      pageConfig:{
        page: 1,
        pageSize: 20,
        totalNum: 0
      }
    }
  },
  computed: {
    state(status){
      if( status === 1 ){
        return '进行中'
      }else if( status === 2 ){
        return '未开始'
      }else if( status === 3){
        return '已过期'
      }
      return ''
    }
  },
  created(){
    this.getOrgActive()
  },
  methods:{
    getOrgActive(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        page: this.pageConfig.page,
        page_size: this.pageConfig.pageSize
      }
      apiGetOrgActiveList(params).then(res=>{
        if (res.data.code == 200) {
          this.orgActiveList = res.data.data.list;
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

.organization-activety-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  .activity-item {
    height: 140px;
    border: 1px solid red;
    width: 690px;
    margin-bottom: 20px;
    padding: 20px;
    display: flex;
    img {
      width: 300px;
      height: 100px;
      margin-right: 20px;
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
    font-size: 18px;
    text-align: left;
    @include ignore();
    margin: 10px auto;
  }
  .status {
    width: 80px;
    height: 26px;
    line-height: 26px;
    background: rgba(204, 204, 204, 1);
    border-radius: 5px;
    color: #fff;
  }
  .active-status {
    background: $orangeColor;
  }
}
</style>