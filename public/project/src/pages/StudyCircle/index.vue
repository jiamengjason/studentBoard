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
          <router-link :to="{name: 'question'}">提个问题</router-link>
          <!-- <router-link :to="{name: 'studyCircle'}">回答问题</router-link> -->
        </div>
        <div v-for="(v, i) in qaList" :key="i" class="q-item">
          <p>Q：我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下？</p>
          <p>A：我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么</p>
          <div class="st-message-zan">
            <span class="time">2020-03-15  12:00</span>
            <span class="zan">10</span>
            <span class="cai">2</span>
          </div>
        </div>

        <div v-if="qaList.length == 0" class="nullCon">暂无内容</div> 
      </div>
      
      <!-- 分页 -->
      <div class="st-page">
        <div v-if="qaList.length > 0" class="st-page">
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
      type: this.$route.query.type || 'all',
      qaList: [],
      pageConfig: {
        page: 1,
        page_size: 20,
        total_num: 0
      }
    };
  },
  computed: {},
  mounted() {
    // 获取机构列表
    this.getList()
  },
  methods: {
    getList(){
      apiQaList({
        'page': this.pageConfig.page,
        'page_size': this.pageConfig.page_size,
      }).then( res => {
        // console.info('res', res)
        if(res.data.code==200){
          this.qaList = res.data.data.list
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
        }else{
          this.qaList = []
        }
      })
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
</style>