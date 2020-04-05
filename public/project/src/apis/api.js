import request from "./request";

//登录
export const apiLoginDoPost = params => request.post(`login/do`, params);
// 注册
export const apiRegisterPost = params => request.post(`login/register`, params);
// 根据手机号获取手机号验证码
export const apigetValidCodePost = params =>
  request.post(`login/getValidCodeByMobile`, params);
// 根据邮箱获取验证码
export const apigetValidEmailPost = params =>
request.post(`login/getValidCodeByEmail`, params);
// 上传文件
export const apiPostUploadFile = (params,config) => {
  return request.post(`index.php?r=uploadFile/index`,params,config);
};
// 获取所有的机构列表
export const apigetOrganizationList = () => {
  return request.get(`siteConfig/getOrganizationList`);
};
// get
export const apiGet = params => {
  return request.get(
    `/organization/members?school_id=${params.school_id}&role_id=${params.role_id}`
  );
};
