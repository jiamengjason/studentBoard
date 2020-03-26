<template>
  <div class="searchBar">
    <div class="searchBarcon">
      <el-row>
        <el-col :span="8" class="sort">
          <span class="hover">综合排序</span>
          <span class="icon">评价升序</span>
          <span class="icon">评价降序</span>
        </el-col>
        <el-col :span="16" class="st-search">
          <el-input
            placeholder="请输入内容"
            suffix-icon="el-icon-search"
            :model="search"
          >
          </el-input>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchBar",
  data() {
    return {
        search: ''
    };
  }
}
</script>  

<style lang="scss" scoped>
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
            span{
                margin-right: 10px;
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
        }

        .el-input__inner{
            background:rgba(229,229,229,1);
            color:rgba(153,153,153,1);
        }
    }
}
</style>