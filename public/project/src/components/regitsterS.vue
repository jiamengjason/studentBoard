<template>
  <div class="registerTagBox">
    <div class="container">
      <el-form ref="form" :model="form" label-width="100px">
        <el-form-item label="学生姓名" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="手机号" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="密码" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="确认密码" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="邮箱" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="手机验证码" required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSubmit" round>立即注册</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>

</template>
<script>
  export default {
    name: 'registerS',
    mounted(){
    },
    data() {
      return {
        form: {
          name: ''
        }
      }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      }
    }
  }
</script>
<style lang="scss">

</style>