<template>
  <div class="userInfo">
    <div>
      <template v-if="activeList.length > 0">
        
      </template>

      <p v-else class="empty-con">暂无数据</p>
    </div>
  </div>

</template>
<script>
import {apiGetMyActiveList} from "../api";

  export default {
    name: 'userinfo',
    mounted(){
    },
    created() {
    },
    data() {
      return {
        activeList:[],
        pageConfig:{
          page: 1,
          pageSize: 20,
          totalNum: 0
        }
      }
    },
    computed: {
      state(status){
        if( status === 1 ){
          return '进行中'
        }else if( status === 2 ){
          return '未开始'
        }else if( status === 3){
          return '已过期'
        }
        return ''
      }
    },
    created(){
      this.getMyActive()
    },
    methods: {
      getMyActive(){
        let params = {
          userId: this.GLOBAL.userId,
          token: this.GLOBAL.token,
          page: this.pageConfig.page,
          page_size: this.pageConfig.pageSize
        }
        apiGetMyActiveList(params).then(res=>{
          if (res.data.code == 200) {
            this.activeList = res.data.data.list;
            // 总条数
            this.pageConfig.totalNum = parseInt(res.data.data.total_num)
          }else{
            this.$message.error(res.data.msg);
          }
        })
      }
    }
  }
</script>
<style lang="scss" scoped>
    .userInfo{
        margin: 20px;
    }

    .top-title-warp {
        width: 100%;
        max-width: 1400px;
        height: 50px;
        background: #fff;
        line-height: 50px;
        border-bottom: 2px solid #dae2f8;
        text-align: left;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        .top-title-line {
            width: 4px;
            height: 22px;
            background: #dae2f8;
            display: inline-block;
            margin: 0 10px 0 40px;
            vertical-align: sub;
        }
        .top-title-text {
            font-size: 16px;
            color: #162f3b;
        }
    }

    .btns{
      margin-top: 50px;
      text-align: center;
    }
</style>