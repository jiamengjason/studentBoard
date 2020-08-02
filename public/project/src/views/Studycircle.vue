<template>
  <div class="find bg2">
    <!-- 头部 -->
    <Header></Header>
    <div class="find container containerBgColor1">

      <el-tabs class="find-tab" v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="综合" name="first">
          <!-- 综合 -->
          <div class="find-list">
            <el-card :class="{ 'box-card': true, 'qlbg1': o.type=='1', 'qlbg': o.type=='2' }" v-for="o in list" :key="o">
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
                  <el-col :span="18">
                    <div class="grid-content bg-purple" v-if="o.type==1">
                        <p class="tit">
                            小XXXX明 
                            <span class="f12 pl20">波士顿大学</span>
                        </p>
                        <div class="student-desc">
                            <el-row :gutter="10">
                            <el-col :span="4">
                                <p style="margin-top:14px;">
                                    <span class="el-icon-location-outline"></span>
                                    波士顿，北京
                                </p>
                                <p class="desc">
                                    <span class="el-icon-reading"></span>
                                    经济学
                                </p>
                            </el-col>
                            <el-col :span="20">
                                <div class="q-desc">
                                    <el-input type="textarea" v-model="o.desc" readonly="true"></el-input>
                                </div>
                            </el-col>
                            </el-row>
                            
                        </div>
                    </div>

                    <div class="grid-content bg-purple" v-if="o.type==2">
                        <p class="tit">
                            纽约大学互助群 
                            <span class="f12 pl20">纽约大学</span>
                        </p>
                        <div class="q-desc">
                            <el-input type="textarea" v-model="o.desc" readonly="true"></el-input>
                        </div>
                    </div>
                  </el-col>
                  <el-col :span="3">
                      <div class="QRcode">
                        <div class="el-icon-lock"></div>
                        <el-image
                        style="width: 120px; height: 120px;"
                        src="sdsd"
                        fit="cover">
                        <div slot="placeholder" class="image-slot">
                            加载中<span class="dot">...</span>
                        </div>
                        </el-image>
                      </div>
                  </el-col>
                </el-row>
              </div>
            </el-card>
          </div>
        </el-tab-pane>
        <el-tab-pane label="群聊" name="second">
          <!-- 群聊 -->
          <div class="find-list">
            <el-card class="box-card qlbg" v-for="o in list" :key="o">
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
                  <el-col :span="18">
                    <div class="grid-content bg-purple">
                        <p class="tit">
                            纽约大学互助群 
                            <span class="f12 pl20">纽约大学</span>
                        </p>
                        <div class="q-desc">
                            <el-input type="textarea" v-model="o.desc" readonly="true"></el-input>
                        </div>
                    </div>
                  </el-col>
                  <el-col :span="3">
                    <div class="QRcode">
                        <div class="el-icon-lock"></div>
                        <el-image
                        style="width: 120px; height: 120px;"
                        src="sdsd"
                        fit="cover">
                        <div slot="placeholder" class="image-slot">
                            加载中<span class="dot">...</span>
                        </div>
                        </el-image>
                      </div>
                  </el-col>
                </el-row>
              </div>
            </el-card>
          </div>
        </el-tab-pane>
        <el-tab-pane label="同学" name="third">
          <!-- 同学 -->
          <div class="find-list">
            <el-card class="box-card" v-for="o in list" :key="o">
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
                  <el-col :span="18">
                    <div class="grid-content bg-purple">
                        <p class="tit">
                            小XXXX明 
                            <span class="f12 pl20">波士顿大学</span>
                        </p>
                        <div class="student-desc">
                            <el-row :gutter="10">
                            <el-col :span="4">
                                <p style="margin-top:14px;">
                                    <span class="el-icon-location-outline"></span>
                                    波士顿，北京
                                </p>
                                <p class="desc">
                                    <span class="el-icon-reading"></span>
                                    经济学
                                </p>
                            </el-col>
                            <el-col :span="20">
                                <div class="q-desc">
                                    <el-input type="textarea" v-model="o.desc" readonly="true"></el-input>
                                </div>
                            </el-col>
                            </el-row>
                            
                        </div>
                    </div>
                  </el-col>
                  <el-col :span="3">
                    <div class="QRcode">
                        <div class="el-icon-lock"></div>
                        <el-image
                        style="width: 120px; height: 120px;"
                        src="sdsd"
                        fit="cover">
                        <div slot="placeholder" class="image-slot">
                            加载中<span class="dot">...</span>
                        </div>
                        </el-image>
                      </div>
                  </el-col>
                </el-row>
              </div>
            </el-card>
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
export default {
  name: 'find',
  data() {
    const generateData = _ => {
        const list = [];
        for (let i = 1; i <= 15; i++) {
            var item = {
                type:'1',
                key: i,
                desc: `简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介简介 ${ i }`,
            }
            if(i%2 ==0){
                item.type = '2'
            }
            list.push(item);
        }
        return list;
    };
    return {
      activeName: 'first',
      list: generateData()
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
.f12{
    font-size: 12px;
     color: #666666;
}
.pl20{
    padding-left: 20px;
}
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
      background: #ffffff!important;
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
  .qlbg{
    background: rgb(218, 226, 248, 1);
  }
  .qlbg1{
    background: rgb(224, 230, 240, 1);
  }
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

    .QRcode{
        width: 120px;
        height: 120px;
        position: relative;
        .el-icon-lock{
            font-size: 20px;
            font-weight: bold;
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top:0;
            z-index: 1;
            text-align: center;
            line-height: 120px;
            opacity: 0.5;
        }
    }
  }
}


.q-desc{
    width: 60%;
    margin-top: 10px;
    .el-textarea__inner{
        height: 68px;
        resize: none;
    }
}
</style>
