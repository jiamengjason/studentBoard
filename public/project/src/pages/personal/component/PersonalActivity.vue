<template>
  <div class="personal-activety-list">
    <div v-for="(item,index) in list" :key="index" class="activity-item">
      <img :src="item.title_img" alt />
      <div class="activity-item-bottom">
        <div class="title-status">
          <p class="title">{{ item.title }}</p>
          <p>{{ state(item.status) }}</p>
        </div>
        <p class="desc">{{ item.desc }}</p>
      </div>
    </div>
    <!-- 分页 -->
    <div v-if="activeList.length > 0" class="st-page">
      <el-pagination 
        background
        :page-size="pageConfig.pageSize"
        :current-page.sync="pageConfig.page"
        layout="prev, pager, next"
        :total="pageConfig.totalNum"
      >
      </el-pagination>
    </div>
  </div>
</template>
<script>
import { apiGetMyActiveList } from "@/apis/api";
export default {
  data(){
    return {
      activeList:[
        {
          title: "123123",
          title_img: "https://www.baidu.com/img/bd_logo1.png",
          desc: "5",
          addr: "6",
          start_time: "2020-03-20 00:00:00",  //活动开始时间
          end_time: "2020-03-30 00:00:00",    //活动结束时间
          attend_tim: "2020-03-31 12:12:03",  //学生参加时间  
          status: 1  //活动是否开始：1进行中 2未开始 3已过期
        }
      ],
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
    this.getMyActive()
  },
  methods:{
    getMyActive(){
      let params = {
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token'),
        page: this.pageConfig.page,
        page_size: this.pageConfig.pageSize
      }
      apiGetMyActiveList(params).then(res=>{
        if (res.data.code == 200) {
          this.activeList = res.data.data.list;
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
.personal-activety-list {
  display: flex;
  display: -webkit-flex;
  justify-content: space-between;
  flex-direction: row;
  flex-wrap: wrap;
  max-width: 1400px;
  width: 100%;
  margin: 40px auto 0;
  .activity-item {
    height: 340px;
    border: 1px solid red;
    width: 690px;
    margin-bottom: 20px;
    img {
      width: 100%;
      height: 230px;
    }
  }
  .activity-item:nth-child(odd) {
    margin-right: 20px;
    border: 1px solid blue;
  }
  .activity-item-bottom {
    padding: 20px;
  }
  .title-status {
    display: flex;
    justify-content: space-between;
  }
  .title {
    font-size: 28px;
    color: rgba(51, 51, 51, 1);
    margin-bottom: 0;
    flex: 1;
    @include ignore();
  }
  .desc {
    color: rgba(153, 153, 153, 1);
    font-size: 24px;
    text-align: left;
    @include ignore();
  }
}
</style>