<template>
  <div class="home">
   ssss
  </div>
</template>

<script>

export default {
  name: 'home',
  data() {
    return {
    }
  },
  mounted(){
  },
  components: {
  },
  methods: {
    // 邮轮品牌
    getPPnav(){
      this.$http.get('/API/index.ashx?command=GetShipCompany').then(function (res) {
        res.body = this.formatterNavVal(res.body, 'shipcompany')
        this.navDataPP = res.body
      })
    }
  }
}
</script>

<style lang="scss">

</style>
