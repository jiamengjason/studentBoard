<template>
  <div class="find container containerBgColor">

    <el-tabs class="find-tab" v-model="activeName" @tab-click="handleClick">
      <div class="find-paixu">
        <span class="mlr">智能排序</span>
        <span class="mlr">评分</span>
        <el-dropdown :hide-on-click="false" class="mlr">
          <span class="el-dropdown-link">
            位置<i class="el-icon-caret-bottom el-icon--right"></i>
          </span>
          <el-dropdown-menu slot="dropdown">
            <el-dropdown-item>位置1</el-dropdown-item>
            <el-dropdown-item>位置2</el-dropdown-item>
            <el-dropdown-item>位置3</el-dropdown-item>
            <el-dropdown-item>位置4</el-dropdown-item>
          </el-dropdown-menu>
        </el-dropdown>
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
      </div>
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
                    <el-tag type="success">有优惠<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">环境好<span class="el-icon-plus"></span></el-tag>
                  </p>
                  <p class="tag">
                    <el-tag type="danger">文书<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">同城<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="warning">师资好<span class="el-icon-plus"></span></el-tag>
                  </p>
                </el-col>
              </el-row>
            </div>
          </el-card>
        </div>
      </el-tab-pane>
      <el-tab-pane label="培训" name="second">
        <!-- 培训 -->
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
                    <el-tag type="success">有优惠<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">环境好<span class="el-icon-plus"></span></el-tag>
                  </p>
                  <p class="tag">
                    <el-tag type="success">文书<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">同城<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="warning">师资好<span class="el-icon-plus"></span></el-tag>
                  </p>
                </el-col>
              </el-row>
            </div>
          </el-card>
      </el-tab-pane>
      <el-tab-pane label="教师" name="third">
        <!-- 教师 -->
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
                    <el-tag type="success">有优惠<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">环境好<span class="el-icon-plus"></span></el-tag>
                  </p>
                  <p class="tag">
                    <el-tag type="success">文书<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="info">同城<span class="el-icon-plus"></span></el-tag>
                    <el-tag type="warning">师资好<span class="el-icon-plus"></span></el-tag>
                  </p>
                </el-col>
              </el-row>
            </div>
          </el-card>
      </el-tab-pane>
    </el-tabs>

    
  </div>
</template>

<script>

export default {
  name: 'find',
  data() {
    return {
      activeName: 'first'
    }
  },
  mounted(){
  },
  components: {
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
.find-paixu{
  text-align: center;
  color: #606266;
  font-size: 14px;
  .mlr{
    margin: 10px 20px;
  }
}
.find-tab{
  padding: 40px 0 0 0;
}
// 选项卡
.el-tabs{
  .el-tabs__header{
      width: 287px;
      padding: 5px 8px;
      border-radius: 30px;
      background: rgb(167, 190, 198);
      margin: 0 auto 10px auto;
      .el-tabs__nav-wrap::after{
        display: none;
      }
      .el-tabs__active-bar{
        display: none;
      }
      .el-tabs__item{
        width: 80px;
        margin: 0 5px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        padding: 0;
      }
      .is-active{
        background: rgb(22, 47, 59);
        border-radius: 30px;
        color: #ffffff;
      }
  }
  
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
