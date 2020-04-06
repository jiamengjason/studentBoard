<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div style="height:40px"></div>
    <div class="st-container mt80">
      <!-- banner -->
      <div class="banner">
        <img src="/img/banner_studyCircle.jpg" alt="">
      </div>

      <div class="q-list">
        <div class="q-tit">
          <router-link class="hover" :to="{name: 'studyCircle'}">全部</router-link>
          <router-link :to="{name: 'studyCircle'}">热门问题</router-link>
          <router-link :to="{name: 'studyCircle'}">提个问题</router-link>
          <router-link :to="{name: 'studyCircle'}">回答问题</router-link>
        </div>
        <div v-for="i in 4" :key="i" class="q-item">
          <p>Q：我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下？</p>
          <p>A：我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么</p>
          <div class="st-message-zan">
            <span class="time">2020-03-15  12:00</span>
            <span class="zan">10</span>
            <span class="cai">2</span>
          </div>
        </div>
      </div>
      <!-- 分页 -->
      <div class="st-page">
        <el-pagination background layout="prev, pager, next" :total="1000">
        </el-pagination>
      </div>
    </div> 
    
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:''
    };
  },
  computed: {},
  mounted() {},
  methods: {}
};
</script>

<style lang="scss" scoped>
.q-tit{
  border-bottom: 1px solid #cccccc;
  font-size:24px;
  font-weight:400;
  color:rgba(51,51,51,1);
  height: 78px;
  line-height: 78px;
  a{
    padding: 0 40px;
    color:rgba(51,51,51,1);
    &:hover{
      color:rgba(255,112,1,1);
    }
    &.hover{
      color:rgba(255,112,1,1);
    }
  }
}
.q-list{
  text-align: left;
  margin: 40px 0 140px 0;
  background: #ffffff;

  .q-item{
    padding: 40px;
    font-size:18px;
    line-height: 30px;
    font-weight:400;
    color:rgba(51,51,51,1);
    border-bottom: 1px solid #cccccc;
    .st-message-zan{
      margin-top: 20px;
    }
  }
}
</style>