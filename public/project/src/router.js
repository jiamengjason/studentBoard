import Vue from "vue";
import Router from "vue-router";

import Home from "./pages/home/index";
import Organization from "./pages/organization/index"
import Teachers from "./pages/Teachers/index"
import Activity from "./pages/Activity/index"
import StudyCircle from "./pages/StudyCircle/index"
import AboutUs from "./pages/AboutUs/index"
import Dashboard from "./pages/dashboard/index";
import Register from "./pages/register/index";
import Login from "./pages/login/index";
import Pwd from "./pages/password/index";
import Personal from "./pages/personal/index";

Vue.use(Router);

export default new Router({
  mode: "history",
  // base: process.env.BASE_URL,
  routes: [
    {
      path: "/404",
      component: Error,
      meta: {
        title: "404"
      }
    },
    {
      path: "/",
      component: Home,
      name: 'home',
      meta: {
        title: "首页"
      }
      // redirect: "/dashboard",
      // children: [
      //   {
      //     path: "dashboard",
      //     component: Dashboard,
      //     meta: {
      //       title: "首页"
      //     }
      //   }
      // ]
    }, {
      path: "/organization",
      name: 'organization',
      component: Organization,
      meta: {
        title: "知名机构"
      }
    }, {
      path: "/teachers",
      name: 'teachers',
      component: Teachers,
      meta: {
        title: "知名教师"
      }
    }, {
      path: "/activity",
      name: 'activity',
      component: Activity,
      meta: {
        title: "课外活动"
      }
    }, {
      path: "/studyCircle",
      name: 'studyCircle',
      component: StudyCircle,
      meta: {
        title: "课外活动"
      }
    }, {
      path: "/aboutUs",
      name: 'aboutUs',
      component: AboutUs,
      meta: {
        title: "关于我们"
      }
    }, {
      path: "/register",
      component: Register,
      meta: {
        title: "注册"
      }
    },
    {
      path: "/login",
      component: Login,
      meta: {
        title: "登录"
      }
    },
    {
      path: "/password",
      component: Pwd,
      meta: {
        title: "忘记密码"
      }
    },
    {
      path: "/personal",
      component: Personal,
      meta: {
        title: "个人中心"
      }
    },
    { path: "*", redirect: "/404", hidden: true }
  ]
});
