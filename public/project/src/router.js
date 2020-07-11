import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import ComingSoon from './views/ComingSoon.vue'
Vue.use(Router)

export default new Router({
    // mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        // 首页
        {
            path: '/',
            name: 'index',
            component: Home
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        // 网站建设中ing
        {
            path: '/comingSoon',
            name: 'comingSoon',
            component: ComingSoon
        }
    ],
    scrollBehavior(to, from,savedPosition) {
        return {
            x: 0,
            y: 0
        }
    }
})