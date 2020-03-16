export const homePage = {
  data() {
    return {};
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