import request from "./request";

//登录
export const apiLoginDoPost = params => request.post(`login/do`, params);
// 注册
export const apiRegisterPost = params => request.post(`login/register`, params);
// 根据手机号获取手机号验证码
export const apigetValidCodePost = params =>
  request.post(`login/getValidCode`, params);

// get
export const apiGet = params => {
  return request.get(
    `/organization/members?school_id=${params.school_id}&role_id=${params.role_id}`
  );
};
