import Vue from "vue";
import Router from "vue-router";

import Home from "./pages/home/index";
import Dashboard from "./pages/dashboard/index";
import Register from "./pages/register/index";

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
      redirect: "/dashboard",
      children: [
        {
          path: "dashboard",
          component: Dashboard,
          meta: {
            title: "首页"
          }
        }
      ]
    },
    {
      path: "/register",
      component: Register,
      meta: {
        title: "注册"
      }
    },
    { path: "*", redirect: "/404", hidden: true }
  ]
});
