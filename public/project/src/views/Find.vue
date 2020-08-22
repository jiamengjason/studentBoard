<template>
  <div class="find bg2">
    <!-- 头部 -->
    <Header></Header>
    <div class="find container containerBgColor">

      <el-tabs class="find-tab" :stretch="true" v-model="activeName" @tab-click="handleClick">
        <div class="find-paixu">
          <span class="mlr">智能排序</span>
          <span class="mlr">评分</span>
          <!-- 服务项目 -->
          <el-dropdown :hide-on-click="false" class="mlr">
            <span class="el-dropdown-link">
              服务项目<i class="el-icon-caret-bottom el-icon--right"></i>
            </span>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>服务项目1</el-dropdown-item>
              <el-dropdown-item>服务项目2</el-dropdown-item>
              <el-dropdown-item>服务项目3</el-dropdown-item>
              <el-dropdown-item>服务项目4</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <!-- 位置 -->
          <div class="mlr" style="width:200px;display:inline-block;">
            <treeselect v-model="value" :disable-branch-nodes="true" :show-count="true" :options="cityData" placeholder="请选择位置"/>
          </div>
          
        </div>
        <div style="clear:both"></div>
        <div class="findTag">
          <el-tag type="success">多好评<span class="el-icon-plus"></span></el-tag>
          <el-tag type="info">优惠<span class="el-icon-plus"></span></el-tag>
          <el-tag type="warning">距离近<span class="el-icon-plus"></span></el-tag>
          <el-tag type="danger">教学质量好<span class="el-icon-plus"></span></el-tag>
          <el-tag type="info">环境好<span class="el-icon-plus"></span></el-tag>
          <el-tag type="success">文书<span class="el-icon-plus"></span></el-tag>
          <el-tag type="info">教学负责<span class="el-icon-plus"></span></el-tag>
        </div>
        <el-tab-pane label="中介" name="first">
          <!-- 中介 -->
          <div class="find-list">
            <el-card class="box-card" v-for="o in 14" :key="o">
              <div class="find-list-item">
                <el-row :gutter="20">
                  <el-col :span="3">
                    <el-image
                      style="width: 120px; height: 120px;"
                      src="sdsd"
                      fit="cover">
                      <div slot="placeholder" class="image-slot">
                        加载中<span class="dot">...</span>
                      </div>
                    </el-image>
                  </el-col>
                  <el-col :span="15"><div class="grid-content bg-purple">
                    <p class="tit">XXXX留学</p>
                    <p class="progress">
                      <el-progress :percentage="60" :format="format"></el-progress>
                      <span>36条</span>
                    </p>
                    <p class="desc">{{'简介文案简介文案简介文案简介文案简介文案简介文案 ' + o }}</p>
                  </div></el-col>
                  <el-col :span="6">
                    <p class="tag">
                      <el-tag type="success">有优惠</el-tag>
                      <el-tag type="info">环境好</el-tag>
                    </p>
                    <p class="tag">
                      <el-tag type="danger">文书</el-tag>
                      <el-tag type="info">同城</el-tag>
                      <el-tag type="warning">师资好</el-tag>
                    </p>
                  </el-col>
                </el-row>
              </div>
            </el-card>
          </div>
        </el-tab-pane>
        <el-tab-pane label="培训" name="second">
          <!-- 培训 -->
          <div class="find-list">
            <el-card class="box-card" v-for="o in 14" :key="o">
              <div class="find-list-item">
                <el-row :gutter="20">
                  <el-col :span="3">
                    <el-image
                      style="width: 120px; height: 120px;"
                      src="sdsd"
                      fit="cover">
                      <div slot="placeholder" class="image-slot">
                        加载中<span class="dot">...</span>
                      </div>
                    </el-image>
                  </el-col>
                  <el-col :span="15"><div class="grid-content bg-purple">
                    <p class="tit">XXXX教师</p>
                    <p class="progress">
                      <el-progress :percentage="60" :format="format"></el-progress>
                      <span>36条</span>
                    </p>
                    <p class="desc">{{'简介文案简介文案简介文案简介文案简介文案简介文案 ' + o }}</p>
                  </div></el-col>
                  <el-col :span="6">
                    <p class="tag">
                      <el-tag type="success">有优惠</el-tag>
                      <el-tag type="info">环境好</el-tag>
                    </p>
                    <p class="tag">
                      <el-tag type="danger">文书</el-tag>
                      <el-tag type="info">同城</el-tag>
                      <el-tag type="warning">师资好</el-tag>
                    </p>
                  </el-col>
                </el-row>
              </div>
            </el-card>
          </div>
        </el-tab-pane>
        <el-tab-pane label="教师" name="third">
          <!-- 教师 -->
          <div class="find-list">
            <el-row :gutter="20">
              <el-col :span="25" v-for="(o, index) in 16" :key="index">
                <el-card :body-style="{ padding: '0px' }">
                  <el-image
                      style="width: 214px; height: 214px;"
                      src="sdsd"
                      fit="cover">
                      <div slot="placeholder" class="image-slot">
                        加载中<span class="dot">...</span>
                      </div>
                    </el-image>
                  <div style="padding: 14px;">
                    <p class="tit-teacher">XXX</p>
                    <p class="desc-teacher">简单文案文案文案简单文案文案文案</p>
                  </div>
                </el-card>
              </el-col>
            </el-row>
          </div>
        </el-tab-pane>
      </el-tabs>

      
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
  
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
import citys from '../assets/data/citys.js'

export default {
  name: 'find',
  data() {
    return {
      activeName: 'first',
      value:null,
      cityData: citys.citys
    }
  },
  created () {
    console.log('this.cityData', this.cityData.citys)   // 得到daily里面的数据
  },
  mounted(){
  },
  components: {
    Header,
    Footer,
    Treeselect
  },
  methods: {
    handleClick(tab, event) {
      console.log(tab, event);
    },
    format(percentage) {
      return percentage === 100 ? '${percentage}分' : `${percentage}分`;
    }
  }
}
</script>

<style lang="scss">
.el-col.el-col-25{
  width: 20%;
  margin-bottom: 20px;
  &:last-child{
    margin-bottom: 0;
  }
  img{
    max-height: 235px;
  }
}
.find-paixu{
  text-align: center;
  color: #606266;
  font-size: 14px;
  width: 520px;
  margin: 0 auto;
  .mlr{
    display: inline-block;
    height: 36px;
    line-height: 36px;
    margin: 0 20px;
    float: left;
    cursor: pointer;
  }
  .hover{
    color: chocolate;
    border-bottom: 1px solid chocolate;
  }
}
.find-tab{
  padding: 40px 0 0 0;
}
.findTag{
  text-align: center;
  .el-tag{
    margin: 10px 10px 40px 10px;
  }
}
// 列表内容
.find-list{
  padding: 10px;
  .box-card{
    margin-bottom: 20px;
    &:last-child{
      margin-bottom: 0;
    }
  }
  .tit-teacher{
    font-size: 16px;
    margin-bottom: 10px;
  }
  .desc-teacher{
    font-size: 14px;
    color: #666666;
  }

  .find-list-item{
    .el-image{
      border: 1px solid #3333;
      border-radius: 5px;
    }
    .tit{
      font-size: 16px;
      margin: 10px 0 5px 0;
    }
    .progress{
        .el-progress{
          width: 300px;
          display: inline-block;
        }
        span{
          line-height: 30px;
          display: inline-block;
        }
    }
    
    .desc{
      font-size: 14px;
      color: #666666;
      margin: 10px 0 0 0;
    }

    .tag{
      text-align: right;
      margin: 10px 0;
      .el-tag{
        margin-left: 5px;
      }
    }
  }
}
</style>
