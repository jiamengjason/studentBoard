import Vue from "vue";
import Router from "vue-router";

import Home from "./pages/home/index";
import Search from "./pages/search/index";
import Organization from "./pages/organization/index"
import OrganizationInfo from "./pages/organizationinfo/index"
import OrganizationValuation from "./pages/OrganizationValuation/index"
import Teachers from "./pages/Teachers/index"
import TeachersInfo from "./pages/TeachersInfo/index"
import TeacherValuation from "./pages/TeacherValuation/index"
import Activity from "./pages/Activity/index"
import ActivityInfo from "./pages/ActivityInfo/index"
import StudyCircle from "./pages/StudyCircle/index"
import Question from "./pages/StudyCircleQuestion/index"
import AboutUs from "./pages/AboutUs/index"
import Register from "./pages/register/index";
import Identity from "./pages/identity/index";
import RegisterSuccess from "./pages/register-success/index";
import Login from "./pages/login/index";
import Pwd from "./pages/password/index";
import Personal from "./pages/personal/index";

Vue.use(Router);

const router = new Router({
  mode: "history",
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
    }, {
      path: "/search",
      name: 'search',
      component: Search,
      meta: {
        title: "搜索"
      }
    }, {
      path: "/organization",
      name: 'organization',
      component: Organization,
      meta: {
        title: "知名机构"
      }
    }, {
      path: "/orgvaluation",
      name: 'orgvaluation',
      component: OrganizationValuation,
      meta: {
        title: "知名机构_评价"
      }
    }, {
      path: "/organizationinfo",
      name: 'organizationinfo',
      component: OrganizationInfo,
      meta: {
        title: "知名机构_详情"
      }
    }, {
      path: "/teachers",
      name: 'teachers',
      component: Teachers,
      meta: {
        title: "知名教师"
      }
    }, {
      path: "/teachersinfo",
      name: 'teachersinfo',
      component: TeachersInfo,
      meta: {
        title: "知名教师_详情"
      }
    }, {
      path: "/teachervaluation",
      name: 'teachervaluation',
      component: TeacherValuation,
      meta: {
        title: "知名教师_评价"
      }
    },{
      path: "/activity",
      name: 'activity',
      component: Activity,
      meta: {
        title: "课外活动"
      }
    }, {
      path: "/activityinfo",
      name: 'activityinfo',
      component: ActivityInfo,
      meta: {
        title: "课外活动_详情"
      }
    }, {
      path: "/studyCircle",
      name: 'studyCircle',
      component: StudyCircle,
      meta: {
        title: "留学圈"
      }
    }, {
      path: "/question",
      name: 'question',
      component: Question,
      meta: {
        title: "提个问题"
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
      name: "register",
      component: Register,
      meta: {
        title: "注册"
      }
    }, {
      path: "/identity",
      name: "identity",
      component: Identity,
      meta: {
        title: "身份选择"
      }
    },
    {
      path: "/register-success",
      component: RegisterSuccess,
      meta: {
        title: "注册成功"
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
      name: 'personal',
      component: Personal,
      meta: {
        title: "个人中心"
      }
    },
    { path: "*", redirect: "/404", hidden: true }
  ]
});

router.afterEach((to, from) =>{
  if(to.name == 'home' && from.name != 'home' && from.name){
    // window.location.reload();
  }else{
    document.body.style.overflow = "auto";
  }
})

export default router
