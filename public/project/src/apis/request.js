import Vue from "vue";
import axios from "axios";
// import { isDevEnv, getApiPrefix, getApiHttp } from "@/utils/env";
// import { apiError } from "@/utils/log";

// const apiPrefix = getApiPrefix();
// const apiHttp = getApiHttp();
// axios 的封装处理-
// let baseURL = `${apiHttp}://${apiPrefix}studentboard.com/index.php?r=`;
// let baseURL = process.env.VUE_APP_BASE_API

// if (isDevEnv()) {
  let baseURL = "/v1";
// }

axios.defaults.withCredentials = true;
axios.defaults.timeout = 50000;
axios.defaults.headers.common["Content-Type"] = "application/json";
axios.defaults.baseURL = baseURL;
Vue.prototype.axios = axios;

// 错误状态码 有返回错误直接进行操作-
const errorStatus = [401, 500, 502, 504, 400];

// 中间件 拦截请求-
axios.interceptors.response.use(
  response => {
    if (errorStatus.indexOf(response.status) > -1) {
      router.push({
        path: "/"
      });
    }
    if ([403, -505].indexOf(response.data.code) > -1) {
      console.log("服务器错误");
    }
    return response;
  },
  err => {
    // const res = err.response;
    // const option = {
    //   status: res.status,
    //   url: res.config.url,
    //   params: res.config.params
    // };
    // apiError("ApiError", option);
    return Promise.reject(err);
  }
);

/**
 * get
 * @param url
 * @param data
 * @returns {Promise}
 */

const get = (url, params = {}) => {
  return new Promise((resolve, reject) => {
    axios
      .get(url, {
        params: params
      })
      .then(response => {
        resolve(response);
      })
      .catch(err => {
        reject(err);
      });
  });
};

/**
 * post
 * @param url
 * @param data
 * @returns {Promise}
 */

const post = (url, data = {},config = {}) => {
  return new Promise((resolve, reject) => {
    axios.post(url, data,config).then(
      response => {
        resolve(response);
      },
      err => {
        reject(err);
      }
    );
  });
};

export default {
  get,
  post,
  baseURL
};
