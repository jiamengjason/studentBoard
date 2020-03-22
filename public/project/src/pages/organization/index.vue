<template>
  <div class="layout">
    <Hearder></Hearder>
    <SearchBar></SearchBar>
    <div class="organization-list">
      <el-row :gutter="20">
          <el-col :span="6" class="sort">
              1
          </el-col>
          <el-col :span="6" class="st-search">
              2
          </el-col>
          <el-col :span="6" class="sort">
              1
          </el-col>
          <el-col :span="6" class="st-search">
              2
          </el-col>
      </el-row>
    </div>
    <Footer class="homefooter"></Footer> 
  </div>
</template>
<script>
import Hearder from "../../components/Hearder";
import Footer from "../../components/Footer";
import SearchBar from "../../components/SearchBar";

export default {
  name: "Home",
  components: {
    Hearder,
    Footer,
    SearchBar
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

</style>