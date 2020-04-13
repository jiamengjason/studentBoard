<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="st-container mt80 serchpage">
      <div class="st-search-nav">
        <el-form ref="form" label-width="100px">
          <!-- 类型 -->
          <el-form-item label="类型：">
            <el-radio-group v-model="tagtype" size="small" @change="getSearch">
              <el-radio-button label="全部"></el-radio-button>
              <el-radio-button label="机构"></el-radio-button>
              <el-radio-button label="老师"></el-radio-button>
            </el-radio-group>
          </el-form-item>
          <!-- 业务 -->
          <el-form-item label="业务：">
            <el-radio-group v-model="orgYewuVal" size="small" @change="getSearch">
              <el-radio-button label="全部" name="type"></el-radio-button>
              <el-radio-button
                v-for="(item,index) in organizationYewu"
                :key="index"
                :label="item"
              >
                {{ item }}
              </el-radio-button>
            </el-radio-group>
          </el-form-item>
          <!-- 课程 -->
          <el-form-item label="课程：">
            <el-radio-group v-model="courseVal" size="small" @change="getSearch">
              <el-radio-button label="全部"></el-radio-button>
              <el-radio-button
                v-for="(item,index) in teacherCourse"
                :key="index"
                :label="item"
              >
                {{ item }}
              </el-radio-button>
            </el-radio-group>
          </el-form-item>
        </el-form>
      </div>
      <!-- 列表 -->
      <div class="organization-list">
        <el-row :gutter="20">
          <el-col v-for="(item, index) in searchList" :key="index" :span="6" class="sort">
            <router-link :to="{name: 'organizationinfo', query:{organization_id: item.user_id}}">
              <OrgList v-if="item.role_id == 1" :item="item" />
              <TeachList v-if="item.role_id == 2" :item="item" />             
            </router-link>
          </el-col>
        </el-row>

        <div v-if="searchList.length == 0" class="nullCon">暂无活动内容</div> 

        <!-- 分页 -->
        <div v-if="searchList.length > 0" class="st-page">
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
import OrgList from "../home/components/OrgList";
import TeachList from "../home/components/TeachList";
import { apiSearch } from "@/apis/api_st";
import { apiGetSiteConfig } from "@/apis/api";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer,
    OrgList,
    TeachList
  },
  data() {
    return {
      organizationYewu: [],
      teacherCourse: [],
      courseVal: '全部',
      orgYewuVal:'全部',
      search:'',
      searchList: [],
      tagtype:'全部',
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
    this.getSiteConfig()
    // 获取机构列表
    this.getSearch()
  },
  methods: {
    // 获取网站配置
    getSiteConfig(){
      apiGetSiteConfig().then(res => {
        if (res.data.code == 200) {
          this.organizationYewu = res.data.data.organization_yewu;
          this.teacherCourse = res.data.data.teacher_course;
        }else{
          this.$message.error('网站数据升级中，请稍后再试');
        }
      })
    },
    getSearch(){
      let params = this.resetParams()
      // 获取搜索的接口
      apiSearch(params).then(res => {
        if(res.data.code === 200){
          this.searchList = res.data.data.list
          // 总条数
          this.pageConfig.total_num = parseInt(res.data.data.total_num)
        }else{
          this.$message.error(res.data.msg);

        }
      })
      
    },
    resetParams(){
      // 设置role_id 的值
      let role_id = null;
      if(this.tagtype == '全部'){
        role_id = '';
      }else if(this.tagtype == '机构'){
        role_id = 1;
      }else if(this.tagtype == '老师'){
        role_id = 2;
      }

      let orgYewuVal = this.orgYewuVal
      if(this.orgYewuVal == '全部'){
        orgYewuVal = null
      }

      let courseVal = this.courseVal
      if(this.courseVal == '全部'){
        courseVal = null
      }

      let paramsTmp = {
        name: this.$route.query.searchText,
        role_id: role_id,
        page: this.pageConfig.page,
        page_size: this.pageConfig.page_size,
        organization_yewu: orgYewuVal,  //机构所属业务
        teacher_course: courseVal,    //老师课程
      }
      return paramsTmp
    }
  }
};
</script>
 <style lang="scss">
// .st-search-nav{
  // .el-form-item{
  //   margin-bottom: 10px;
  //   .el-form-item__label{
  //     font-size:20px!important;
  //     font-weight:400!important;
  //     color:rgba(153,153,153,1)!important;
  //   }
  // }
  // .el-checkbox-button__inner{
  //   margin: 0!important;
  //   background: none!important;
  //   font-size:20px!important;
  //   font-weight:400;
  //   color:rgba(153,153,153,1)!important;
  // }
// }


.serchpage{
  .organization-list{
    width: 1400px;
    margin:  0 auto 50px auto;
    .con{
      height: 105px;
      overflow: hidden;
    }
    .el-col{
      margin-bottom: 20px;
    }
  }
}
</style>
<style lang="scss" scoped>
.st-search-nav{
  background: #ffffff;
  padding: 40px;
  text-align: left;
  margin-bottom: 40px;
}

</style>