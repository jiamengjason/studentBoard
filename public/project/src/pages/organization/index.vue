<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <SearchBar></SearchBar>
    <div class="organization-list">
      <el-row :gutter="20">
        <el-col v-for="(v, i) in orgList" :key="i" :span="6" class="sort">
          <router-link :to="{name: 'organizationinfo', query:{organization_id: v.user_id}}">
            <div class="jigou-item">
              <div class="img">
                <!-- <img src="/img/home/jigou.jpg" alt=""> -->
                <el-image
                  style="width: 335px; height: 252px"
                  :src="v.head_img ? v.head_img : '/img/avatar_jigou.png'"
                  fit="contain"
                >
                </el-image>
              </div>
              <div class="con">
                <p>
                  <span class="leftlabel">评分：</span>
                  <span class="sore">{{ v.score || '0.0' }}</span>
                </p>
                <p class="kcclass">
                  <span class="leftlabel">服务：</span>
                  <span>{{v.organization_yewu || '暂无'}}</span>
                </p>
                <p>
                  <span class="leftlabel">名称：</span>
                  <span>{{v.organization_name}}</span>
                </p>
              </div>
            </div>
          </router-link>
        </el-col>
      </el-row>
      <!-- 分页 -->
      <div v-if="orgList.length > 0" class="st-page">
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
import { apiGetOrganizationList } from "@/apis/api_st";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer,
    SearchBar
  },
  data() {
    return {
      search:'',
      count:12,
      orgList: [],
      pageConfig: {
        page: 1,
        page_size: 20,
        total_num: 0
      },
      score_sort: null
    };
  },
  computed: {},
  mounted() {
    // 获取机构列表
    this.getList()
  },
  methods: {
    getList(){
      // 获取机构列表
      apiGetOrganizationList({
        'page': this.pageConfig.page,
        'page_size': this.pageConfig.page_size,
        'score_sort': this.score_sort
      }).then(res => {
        // console.info('res', res)
        if(res.data.code==200){
          this.orgList = res.data.data.list
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
        }else{
          this.orgList = []
        }
      })
    },
    changeSearchType(value){
      this.type = value
      console.info('父组件value=====', this.type)
    }
  }
};
</script>

<style lang="scss" scoped>
.organization-list{
  width: 1400px;
  margin:  0 auto 50px auto;
  .jigou-item{
    background:rgba(255,255,255,1);
    border-radius:10px;
    box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
    // 图片
    .img{
      width:335px;
      height:252px;
      background: #cccccc;
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
        margin: 0;
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
</style>