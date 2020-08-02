import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Find from './views/Find.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import ComingSoon from './views/ComingSoon.vue'
import Activity from './views/Activity.vue'
import Studycircle from './views/Studycircle.vue'
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
        // 登录
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        // 注册
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        // 找一找
        {
            path: '/find',
            name: 'find',
            component: Find
        },
        {
            path: '/home',
            name: 'home',
            component: Home
        },{
            path: '/activity',
            name: 'activity',
            component: Activity
        },{
            path: '/studycircle',
            name: 'studycircle',
            component: Studycircle
        },
        // 网站建设中ing
        {
            path: '/comingSoon',
            name: 'comingSoon',
            component: ComingSoon
        }
    ]
})