import Vue from 'vue'
import Element from 'element-ui'
import '../element-variables.scss'
// fade/zoom 等
import 'element-ui/lib/theme-chalk/base.css';
// collapse 展开折叠
import CollapseTransition from 'element-ui/lib/transitions/collapse-transition';

Vue.use(Element)
Vue.component(CollapseTransition.name, CollapseTransition)
