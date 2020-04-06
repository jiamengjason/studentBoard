export const homePage = {
  data() {
    return {
      successPath:1
    };
  },
  methods: {
    // 忘记密码
    toPwdPageFn() {
      this.$router.push("/password");
    },
    // 去注册
    toRegPageFn() {
      this.$router.push("/register");
    },
    // 注册成功
    toRegisterSuccessPageFn(){
      this.$router.push({
        path:"/register-success",
        query: {
          id: this.successPath
        }
      });
    },
    // 去首页
    toHomePageFn() {
      this.$router.push("/");
    },
    // 去登录
    toLoginPageFn() {
      this.$router.push("/login");
    }
  }
};
