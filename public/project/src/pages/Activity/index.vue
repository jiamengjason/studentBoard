<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <SearchBar search-type="active"></SearchBar>
    <div class="organization-list">
      <el-row v-if="activeList.length > 0" :gutter="20">
        <el-col v-for="(v, i) in activeList" :key="i" :span="12">
          <router-link :to="{ name: 'activityinfo', query: { 'active_id': v.active_id }}">
            <div class="huodong-item">
              <div class="img">
                <el-image
                  style="width: 690px; height: 229px"
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

      <div v-if="activeList.length == 0" class="nullCon">暂无活动内容</div> 

      <!-- 分页 -->
      <div v-if="activeList.length > 0" class="st-page">
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
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import SearchBar from "../../components/SearchBar";
import { apiGetActiveList } from "@/apis/api_st";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer,
    SearchBar
  },
  data() {
    return {
      count:12,
      title: '',
      activeList: [],
      pageConfig:{
        page: 1,
        page_size: 20,
        total_num: 0
      },
      type: ''
    };
  },
  computed: {},
  mounted() {
    // 获取活动列表
    this.getActiveList()
  },
  methods: {
    goSearch(value){
      this.title = value
      this.getActiveList()
    },
    changeSearchType(value){
      this.type = value
      console.info('父组件value=====', this.type)
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
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
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
  width: 1400px;
  margin:  0 auto 50px auto;
  .huodong-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    // 图片
    .img{
      width:690px;
      height:229px;
      img{
        border-radius:10px 10px 0px 0px;
        max-width: 100%;
        max-height: 100%;
      }
      .el-icon-picture-outline:before{
        font-size: 80px;
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