<template>
  <div class="searchBar">
    <div class="searchBarcon">
      <el-row>
        <el-col v-if="searchType != 'active'" :span="8" class="sort">
          <span :class="{'hover': type=='0'}" @click="changeSearType('0')">综合排序</span>
          <span class="icon" :class="{'hover': type=='1'}" @click="changeSearType('1')">评价升序</span>
          <span class="icon" :class="{'hover': type=='2'}" @click="changeSearType('2')">评价降序</span>
        </el-col>
        <!-- 活动 -->
        <el-col v-if="searchType == 'active'" :span="8" class="sort">
          <span :class="{'hover': type=='0'}" @click="changeSearType('0')">全部</span>
          <span :class="{'hover': type=='1'}" @click="changeSearType('1')">预告</span>
          <span :class="{'hover': type=='2'}" @click="changeSearType('2')">进行中</span>
          <span :class="{'hover': type=='3'}" @click="changeSearType('3')">已结束</span>
        </el-col>
        <el-col :span="16" class="st-search">
          <el-input v-model="searchText" placeholder="搜索关键词内容" class="input-with-select">
            <el-button slot="append" icon="el-icon-search" @click="goSearch"></el-button>
          </el-input>
          <!-- <el-input
            placeholder="搜索关键词内容"
            suffix-icon="el-icon-search"
            v-model="searchText"
          >
          </el-input> -->
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchBar",
  props: {
    searchType: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
        searchText: '',
        type: '0'
    };
  },
  methods: {
    changeSearType(value){
      this.type = value
      console.info('子组件value', value)
      this.$parent.changeSearchType(value)
    },
    goSearch(){
      console.info('this.searchText', this.searchText)
      this.$parent.goSearch(this.searchText)
    }
  }
}
</script>  

<style lang="scss">
.searchBar{
    padding-top: 40px;
    .searchBarcon{
        height: 100px;
        line-height: 100px;
        width: 1400px;
        margin: 80px auto 40px auto;
        background: #ffffff;
        box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.15);
        border-radius:10px;
        .sort{
            font-size:24px;
            font-weight:400;
            color:rgba(51,51,51,1);
            text-align: left;
            padding-left: 40px;
            span{
                margin-right: 15px;
                cursor: pointer;
                &.icon{
                    position: relative;
                    padding: 23px;
                    &::before{
                        content: "";
                        position: absolute;
                        right: 0;
                        top: 0;
                        width: 16px;
                        height: 100%;
                        background: url(/img/icon-sort.png) no-repeat 0 center;
                    }
                }
                &.hover{
                    color: #ff7001;
                }
            }
        }

        .st-search{
          padding-right: 40px;
          .el-input-group{
            .el-input-group__append{
              cursor: pointer;
              background: none!important;
              background-color: transparent!important;
              border: none;
              position: absolute;
              right: 20px;
              top: 12px;
            }
          }
        }

        .el-input__inner{
          background:rgba(229,229,229,1);
          color:rgba(153,153,153,1);
          font-size:20px;
          opacity:0.8;
          border-radius:25px;
          color:rgba(153,153,153,1);
          border: none;
        }
    }
}
</style>