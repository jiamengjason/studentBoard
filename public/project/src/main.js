import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueResource from 'vue-resource'
import VueCookies from 'vue-cookies'
import 'lib-flexible'
import './plugins/element.js'
import VueDirectiveImagePreviewer from 'vue-directive-image-previewer'
import 'vue-directive-image-previewer/dist/assets/style.css'
import 'element-ui/lib/theme-chalk/base.css';
// collapse 展开折叠
import CollapseTransition from 'element-ui/lib/transitions/collapse-transition';

Vue.config.productionTip = false
Vue.use(VueResource)
Vue.use(VueDirectiveImagePreviewer) 
Vue.use(VueCookies)

Vue.component(CollapseTransition.name, CollapseTransition)

let userid = Vue.$cookies.get('userid')
// userid="111"
Vue.prototype.GLOBAL = {
  'userid': userid
}

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
;(function(){
var rem = document.createElement('script');
rem.src = './rem.js';
document.body.appendChild(rem)
})()
