import request from "./request";
const defaultPath = 'index.php?r='
//登录
export const apiLoginDoPost = params => request.post(`${defaultPath}login/do`, params);
// 注册
export const apiRegisterPost = params => request.post(`${defaultPath}login/register`, params);
// 获取网站配置信息
export const apiGetSiteConfig = () => {
  return request.get(`${defaultPath}siteConfig/index`);
};
// 根据手机号获取手机号验证码
export const apiGetValidCodePost = params =>
  request.post(`${defaultPath}login/getValidCodeByMobile`, params);
// 根据邮箱获取验证码
export const apigetValidEmailPost = params =>
request.post(`${defaultPath}login/getValidCodeByEmail`, params);
// 上传文件
export const apiPostUploadFile = (params,config) => {
  return request.post(`${defaultPath}uploadFile/index`,params,config);
};
// 获取所有的机构列表
export const apiGetOrganizationList = () => {
  return request.get(`${defaultPath}siteConfig/getOrganizationList`);
};
// 通过手机号重设密码
export const apiResetPwByMobile = params => {
  return request.post(`${defaultPath}login/resetPwByMobile`,params);
};
// 通过邮箱重设密码
export const apiResetPwByEmail = params => {
  return request.post(`${defaultPath}login/resetPwByEmail`,params);
};
// 获取个人信息
export const apiGetUserInfo = params => {
  return request.post(`${defaultPath}member/info`,params);
};
// 修改用户基本信息
export const apiResetUserUpdate = params => {
  return request.post(`${defaultPath}member/update`,params);
};
// 修改用户绑定信息
export const apiResetUpdateUnion = params => {
  return request.post(`${defaultPath}member/updateUnion`,params);
};
// 参加的活动列表【老师、学生、家长】
export const apiGetMyActiveList = () => {
  return request.get(`${defaultPath}member/myActive`);
};
// 机构的活动列表
export const apiGetOrgActiveList = () => {
  return request.get(`${defaultPath}member/activeList`);
};
// get
export const apiGet = params => {
  return request.get(
    `${defaultPath}/organization/members?school_id=${params.school_id}&role_id=${params.role_id}`
  );
};
