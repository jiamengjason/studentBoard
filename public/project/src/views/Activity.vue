<template>
  <div class="activity bg2">
    <!-- 头部 -->
    <Header></Header>
    <div class="activity container containerBgColor">

      <!-- 教师 -->
        <div class="activity-list">
        <el-row :gutter="20">
            <el-col span="8" v-for="(o, index) in 16" :key="index">
                <el-card :body-style="{ padding: '0px'}">
                    <el-image
                        style="width: 100%; height: 214px;"
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
    </div>
    <!-- 尾部 -->
    <Footer></Footer>
  </div>
  
</template>

<script>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
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
    Header,
    Footer
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
// 列表内容
.activity-list{
  padding: 20px 10px;
  .el-col{
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
