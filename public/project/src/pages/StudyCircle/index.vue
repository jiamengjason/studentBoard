<template>
  <div class="layout">
    <Hearder></Hearder>
    <div class="st-container mt80">
      <!-- banner -->
      <div class="banner">
        <img src="/img/banner_studyCircle.jpg" alt="">
      </div>

      <div class="q-list">
        <div class="q-tit">
          <router-link>全部</router-link>
          <router-link>热门问题</router-link>
          <router-link>提个问题</router-link>
          <router-link>回答问题</router-link>
        </div>
        <div class="q-item">
          <p>Q：我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下,我想问个问题，不知道谁可以回答一下？</p>
          <p>A：我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么,我可以回答你，你想问什么</p>
          <div class="st-message-zan">
            <span class="time">2020-03-15  12:00</span>
            <span class="zan">10</span>
            <span class="cai">2</span>
          </div>
        </div>
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
.q-list{
  text-align: left;
  margin-top: 40px;
  background: #ffffff;

  .q-item{
    padding: 40px;
    font-size:18px;
    line-height: 30px;
    font-weight:400;
    color:rgba(51,51,51,1);
    border-bottom: 1px solid #cccccc;
  }
}
</style>