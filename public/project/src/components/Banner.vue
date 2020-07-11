<template>
  <div class="Banner">
    <HeaderMenu activeIndex="1"></HeaderMenu>
    <div class="banner-search">
      <div class="container">
        <el-row>
          <el-col :span="5">
            <!-- 出发城市 -->
            <el-button class="searchBtn" v-bind:class="{ active: isActiveCh }"  v-popover:popover1>{{isActiveChName}}</el-button>
            <div class="showdropList">
              <el-popover
                ref="popover1"
                placement="bottom-start"
                width="450"
                trigger="click"
                v-model="isActiveCh">
                <el-table :data="departureCity">
                  <el-table-column width="80" property="areaname" label="出发城市"></el-table-column>
                  <el-table-column width="350" class="fjh-table">
                    <template slot-scope="scope">
                      <span @click="showSearchVal('isActiveCh', group.departureport)" v-for="group in scope.row.child" :key="group.id">
                        {{group.departureport}}
                      </span>
                    </template>
                  </el-table-column>
                </el-table>
              </el-popover>
            </div>
          </el-col>
          <el-col :span="5">
            <!-- 出发航线 -->
            <el-button class="searchBtn" v-bind:class="{ active: isActiveHX }" v-popover:popover2>{{isActiveHXName}}</el-button>
            <div class="showdropList">
              <el-popover
                ref="popover2"
                placement="bottom-start"
                width="200"
                trigger="click"
                v-model="isActiveHX">
                <el-table :data="cityList" type="index">
                  <el-table-column
                    label="出发航线"
                    width="180">
                  <template slot-scope="scope">
                        <span style="width:90%; text-align:center;" @click="showSearchVal('isActiveHX', scope.row.areaname)" >
                          {{scope.row.areaname}}
                        </span>
                      </template>
                  </el-table-column>
                  
                  <!-- <el-table-column width="80" property="areaname" label="出发航线"></el-table-column>
                  <el-table-column width="350">
                    <template slot-scope="scope">
                      <span @click="showSearchVal('isActiveHX', group.portname)" v-for="group in scope.row.child" :key="group.id">
                        {{group.portname}}
                      </span>
                    </template>
                  </el-table-column>
                   -->
                </el-table>
              </el-popover>
            </div>
          </el-col>

          <el-col :span="5">
            <!-- 邮轮时长 -->
            <el-button class="searchBtn" v-bind:class="{ active: isActiveYL }" v-popover:popover3>{{isActiveYLName}}</el-button>
            <div class="showdropList">
              <el-popover
                ref="popover3"
                placement="bottom-start"
                width="200"
                trigger="click"
                v-model="isActiveYL">
                <el-table :data="timeList">
                  <el-table-column
                    label="邮轮时长"
                    width="180">
                      <template slot-scope="scope">
                        <span style="width:90%; text-align:center;" @click="showSearchVal('isActiveYL', scope.row.name)" >
                          {{scope.row.name}}
                        </span>
                      </template>
                  </el-table-column>
                </el-table>
              </el-popover>
            </div>
            <!-- <el-select v-model="search.yl" placeholder="热门邮轮">
              <el-option v-for="(item, index) in lineList" :key="index+1"  :label="item.shipcompany" :value="item.id"></el-option>
            </el-select> -->
          </el-col>
          <el-col :span="5">
            &nbsp;
            <!-- 目的地 -->

            <el-button class="searchBtn" v-bind:class="{ active: isActiveMD }" v-popover:popover4>{{isActiveMDName}}</el-button>
            <div class="showdropList">
              <el-popover
                ref="popover4"
                placement="bottom-start"
                width="450"
                trigger="click"
                v-model="isActiveMD">
                <el-table :data="arrivalCity">
                  <el-table-column width="80" property="areaname" label="目的地"></el-table-column>
                  <el-table-column width="350">
                    <template slot-scope="scope">
                      <span @click="showSearchVal('isActiveMD', group.arrivalport)" v-for="group in scope.row.child" :key="group.id">
                        {{group.arrivalport}}
                      </span>
                    </template>
                  </el-table-column>
                </el-table>
              </el-popover>
            </div>

            <!-- <el-select v-model="search.bourn" placeholder="目的地">
              <el-option-group
                v-for="group in cityList"
                :key="group.areaname"
                :label="group.areaname">
                <el-option
                  v-for="item in group.child"
                  :key="item.id"
                  :label="item.portname"
                  :value="item.id">
                </el-option>
              </el-option-group>
            </el-select> -->
          </el-col>
          <el-col :span="4">
            <div class="ylInput">
              <el-input clear="" v-model="searchval" placeholder="请输入邮轮名称"></el-input>
              <a href="javascript:;" @click="handSearch()">
                <img class="searchBtn" src="../assets/img/header/search.png" alt="">
              </a>
            </div>
          </el-col>
        </el-row>
      </div>
    </div>
    <el-carousel :interval="8000" arrow="always">
        <el-carousel-item v-for="item in bannerList" :key="item.id">
          <img :src="item.imgurl" alt="">
        </el-carousel-item>
      </el-carousel>
    </div>
</template>

<script>
import HeaderMenu from './HeaderMenu.vue'
export default {
  name: 'Banner',
  props: {
    lineList: Array
  },
  components: {
    HeaderMenu
  },
  data() {
    return {
      timeList:[{
        id:1,
        name:'5天以内'
      },{
        id:2,
        name:'6-10天'
      },{
        id:3,
        name:'11-15天'
      },{
        id:4,
        name:'15天以上'
      }],
      bannerList:[],
      activeIndex: '1',
      activeIndex2: '1',
      city:[1,2,3],
      searchval: '',
      cityList: [],
      departureCity: [],
      arrivalCity: [],
      isActiveCh:false,
      isActiveHX:false,
      isActiveYL:false,
      isActiveMD:false,
      isActiveChName:'出发城市',
      isActiveHXName:'出发航线',
      isActiveYLName:'邮轮时长',
      isActiveMDName:'目的地',
    };
  },
  mounted(){
    this.getBannerList(),
    this.getCityList(),
    this.getDepartureCity(),
    this.getArrivalCity()
  },
  methods: {
    handSearch() {
      var searchVal = {}
      searchVal.departureport = (this.isActiveChName == '出发城市' ? '' : this.isActiveChName)
      searchVal.area = (this.isActiveHXName == '出发航线' ? '' : this.isActiveHXName)
      searchVal.duration = (this.isActiveYLName == '邮轮时长' ? '' : this.isActiveYLName)
      searchVal.arrivalport = (this.isActiveMDName == '目的地' ? '' : this.isActiveMDName)
      searchVal.searchval = this.searchval
      searchVal = JSON.stringify(searchVal)
      // console.info('searchval====',searchval)
      this.$router.push({path:'YLairline', query:{searchVal: searchVal}})
    },
    getCityList(){
      this.$http.get('/API/index.ashx?command=GetAreaCity').then(function (res) {
        // console.info('res.body===', res.body)
        this.cityList = res.body.list
      })
    },
    getDepartureCity(){
      this.$http.get('/API/index.ashx?command=GetDepartureCity').then(function (res) {
        // console.info('res.body===', res.body)
        this.departureCity = []
        this.departureCity.push({
          "id": 1,
          "areaname": "热门港口",
          "child": res.body.hotcity
        })
        this.departureCity.push({
          "id": 2,
          "areaname": "出发城市",
          "child": res.body.allcity
        })
      })
    },
    getArrivalCity(){
      this.$http.get('/API/index.ashx?command=GetArrivalCity').then(function (res) {
        // console.info('res.body===', res.body)
        this.arrivalCity = []
        this.arrivalCity.push({
          "id": 1,
          "areaname": "热门城市",
          "child": res.body.hotcity
        })
        this.arrivalCity.push({
          "id": 2,
          "areaname": "热门国家",
          "child": res.body.hotcountry
        })
      })
    },
    getBannerList(){
      this.$http.get('/API/index.ashx?command=GetBannerImg').then(function (res) {
        // console.info('data', data)
        this.bannerList = res.body
      })
    },
    showSearchVal(type, value){
      // console.info(type)
      this[type] = !this[type];
      this[type+'Name'] = value;
    }
  }
}
</script>
<style lang="scss">
// 查询条件显示控制
.el-table_1_column_1,.el-table_4_column_5{
  vertical-align: top!important;
}
.el-table__header{
  display: none;
}
// 查询条件显示控制
.Banner{
  position: relative;
  height: 850px;
  background: #d3dce6;
  margin-bottom: 30px;
  .el-carousel__item{
    text-align: center;
  }
  .banner-img{
    max-height: 850px;
  }
  img{
    // max-width: 100%;
    max-height: 100%;
  }
  .el-carousel__container{
    height: 850px;
  }
}
.appnav{
  padding: 10px;
  a{
    color: #333333;
  }
} 

// 搜索
.banner-search{
  position: absolute;
  .container{
    background: #ffffff;
    height: 60px;
    box-shadow:5px 5px 5px rgba(0,0,0,.35);
    border-radius: 10px;
    padding: 10px 30px;
  }
  z-index: 10;
  width: 100%;
  bottom: -30px;
  height: 60px;


  // 搜索图标
  .el-icon-arrow-up::after{
    content: ' '!important;
    background: url(../assets/img/header/up.png) no-repeat;
    position: absolute;
    left: 5px;
    top: 50%;
    width: 20px;
    height: 10px;
    margin-top: -5px;
  }
  .el-input{
    border-right: 1px solid #e5e5e5;
  }
  .el-input__inner{
    border:none;
  }
  .ylInput{
    position: relative;
    .el-input{
      border: none;
    }
    .searchBtn{
      position: absolute;
      right: 8px;
      top: 50%;
      margin-top:-12px;
      width: 24px;
      height: 24px;
    }
    input{
      background: #ededed;
      padding-right: 30px;
      cursor: pointer;
    }
  }
}


@media screen and (max-width: 750px) {
  .Banner{
    height: 425px;
    .banner-img{
      max-height: 425px;
    }
    .el-carousel__container{
      height: 425px;
    }
  }
}


// 搜索区域
.el-popper{
  height: 185px;
  overflow: auto;
}
.cell{
  vertical-align:top!important;
  font-size: 12px;
  font-size: #999999;
  span{
    display: inline-block;
    width: 105px;
    font-size: 12px;
    color: #333333;
    cursor: pointer;
  }
}

.searchBtn{
  border: none;
  position: relative;
  width: 80%;
  border:none!important;
  border-radius: none!important;
  &:hover{
    background: none;
  }
  &::before{
    content: ' '!important;
    background: url(../assets/img/header/down.png) no-repeat;
    position: absolute;
    right: 15%;
    top: 50%;
    width: 20px;
    height: 10px;
    margin-top: -5px;
  }
  &::after{
    position: absolute;
    content: ' '!important;
    right: 0;
    top:0;
    width: 100%;
    height: 100%;
    border-right: 1px solid #e5e5e5!important;
  }
}

.active{
  &::before{
    background: url(../assets/img/header/up.png) no-repeat;
  }
}

@media screen and (max-width: 750px) {
  .banner-search .container{
    padding: 10px 10px;
  }
  .el-button{
    width: 90%;
    text-align: left;
    overflow: hidden;
    white-space: normal;
    padding-left: 0!important;
    padding-right: 0!important;
    text-align: left!important;
    span{
      width: 75%;
      height: 20px;
      line-height: 20px;
      display: inline-block;
      overflow: hidden;
    }
  }
  .searchBtn::before{
    background-size: 80%;
    right: 5px;
  }
}
</style>
