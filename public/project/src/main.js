import Vue from "vue";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import "../theme/index.css"
import { Message } from 'element-ui';
import App from "./App.vue";
import store from "./store";
import router from "./router";
import "lodash";
Vue.config.productionTip = false;

const Bus = new Vue();
Vue.prototype.$bus = Bus;

// element-ui
Vue.use(ElementUI);
Vue.use(Message);
Vue.prototype.$message = Message;

new Vue({
  router,
  render: h => h(App),
  store
}).$mount("#app");
