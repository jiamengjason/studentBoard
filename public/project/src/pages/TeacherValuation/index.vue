<template>
  <div class="layout mainBg">
    <Hearder></Hearder>
    <div class="st-container mt80">
      <!-- 面包屑 -->
      <div class="st-breadcrumb">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item>当前位置</el-breadcrumb-item>
          <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item>知名机构</el-breadcrumb-item>
          <el-breadcrumb-item>教师评价</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
      
      <div class="valuation">
        <div class="valuation-l">
          <img src="/img/home/jigou.jpg" alt="">
        </div>
        <div class="valuation-r">
          <el-form ref="form" :model="valuationForm" label-width="150px">
            <!-- 教学质量 -->
            <el-form-item label="教学质量" :rules="[{required: true}]">
              <div class="st-rate">
                <el-rate
                  v-model="valuationForm.score"
                  :texts="['1分', '2分', '3分', '4分', '5分']"
                  :colors="['#F7BA2A', '#FF9900', '#FF7001']"
                  show-text
                >
                </el-rate>
              </div>
            </el-form-item>
            <!-- 推荐选择 -->
            <el-form-item label="推荐选择" :rules="[{required: true}]">
              是否会推荐给别的学生
              <el-radio-group v-model="valuationForm.is_recommend" size="medium">
                <el-radio-button label="yes"></el-radio-button>
                <el-radio-button label="no"></el-radio-button>
              </el-radio-group>
            </el-form-item>
            <!-- 选择标签 -->
            <el-form-item label="选择标签" :rules="[{required: true}]">
              <el-checkbox-group v-model="valuationForm.tags">
                <el-checkbox-button label="积极反馈" name="type"></el-checkbox-button>
                <el-checkbox-button label="令人尊敬" name="type"></el-checkbox-button>
                <el-checkbox-button label="作业较多" name="type"></el-checkbox-button>
                <el-checkbox-button label="知识不足" name="type"></el-checkbox-button>
                <el-checkbox-button label="态度不佳" name="type"></el-checkbox-button>
                <el-checkbox-button label="回复及时" name="type"></el-checkbox-button>
                <el-checkbox-button label="关心学生" name="type"></el-checkbox-button>
                <el-checkbox-button label="死板无聊" name="type"></el-checkbox-button>
                <el-checkbox-button label="尽心尽力" name="type"></el-checkbox-button>
                <el-checkbox-button label="收费昂贵" name="type"></el-checkbox-button>
                <el-checkbox-button label="幽默风趣" name="type"></el-checkbox-button>
              </el-checkbox-group>
            </el-form-item>
            <!-- 详细评轮 -->
            <el-form-item label="详细评论" :rules="[{required: true}]">
              <el-input v-model="valuationForm.comment" type="textarea" :autosize="{minRows: 6, maxRows: 8}" show-word-limit maxlength="500"></el-input>
            </el-form-item>
            <el-form-item label="验证">
              <div class="container">
                <div id="captcha" style="position: relative"></div>
                <div id="msg"></div>
              </div>
            </el-form-item>
          </el-form>

          <el-button type="primary" @click="doValuate">提交评价</el-button>
        </div>
        <div style="clear:both"></div>
      </div>
      <div style="clear:both"></div>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import { apiDoValuate } from "@/apis/api_st";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer
  },
  data() {
    return {
      search:'',
      count:12,
      head_img: this.$route.query.head_img,
      validation: false,
      valuationForm: {
        // 总体评分
        score: 0,
        // 是否推荐给学生
        is_recommend: null,
        // 标签
        tags:[],
        // 详细评论
        comment: '',
        // 老师id
        evaluated_uid: this.$route.query.evaluated_uid,
        userId: localStorage.getItem('board_user_id'),
        token: localStorage.getItem('board_token')
      }
    };
  },
  computed: {},
  mounted() {
    const self = this;
    // this.dynamicLoadJs("/js/jigsaw.js");
    window.jigsaw.init(document.getElementById('captcha'), function() {
      document.getElementById('msg').innerHTML = '验证成功！'
      self.validation = true;
    }, function() {
      console.info('失败')
      document.getElementById('msg').innerHTML = ''
      self.validation = false;
    })
  },
  methods: {
    // 提交评价
    doValuate(){
      // console.info('this.valuationForm', this.valuationForm)
      var msg = this.checkValuation()
      var self = this
      if(!msg){
        this.valuationForm.tags = this.valuationForm.tags.join(",")
        apiDoValuate(this.valuationForm).then( res => {
            if(res.data.code == '200'){
              this.$message({
                message: '恭喜你，提交成功!',
                type: 'success'
              });
              setTimeout(function(){
                self.$router.push({
                  name: 'teachersinfo', 
                  query: {
                    teacher_id: self.$route.query.evaluated_uid
                  }
                })
              },2000)
            }else{
              this.$message.error(res.data.msg);
            }
          })
        }else{
          this.$message.error(msg);
        }
    },
    checkValuation(){
      if(!this.valuationForm.score){
        return '请选择 "总体评分"'
      }else if(!this.valuationForm.is_recommend && this.valuationForm.is_recommend != 0){
        return '请选择 "推荐选择"'
      }else if(!this.valuationForm.tags){
        return '请选择 "标签"'
      }else if(!this.valuationForm.comment){
        return '请填写详细评论'
      }else if(!this.validation){
        return '请滑动拼图完成验证'
      }else{
        return false
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.valuation{
  background: #ffffff;
  padding: 40px;
  margin-bottom: 140px;
  .valuation-l{
    float: left;
    width: 210px;
    height: 210px;
    border-radius:10px;
    overflow: hidden;
    img{
      max-height: 100%;
    }
  }
  .valuation-r{
    padding: 0 40px;
    width: 1030px;
    float: left;
    text-align: left;
    font-size: 24px;
    
    // 评分
    .st-rate{
      padding-top: 10px;
    }
    .el-button{
      margin-left: 150px;
      margin-top: 40px;
    }
  }
}
</style>