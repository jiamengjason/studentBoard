import request from "./request";
const defaultPath = 'index.php?r='
//登录
export const apiLoginDoPost = params => request.post(`${defaultPath}login/do`, params);
// 注册
export const apiRegisterPost = params => request.post(`${defaultPath}login/register`, params);
// 退出
export const apiLoginOutPost = params => request.post(`${defaultPath}member/logout`, params);

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
export const apiGetMyActiveList = params => {
  return request.get(`${defaultPath}member/myActive&userId=${params.userId}&token=${params.token}&page=${params.page}&page_size=${params.page_size}`);
};
// 机构的活动列表
export const apiGetOrgActiveList = params => {
  return request.get(`${defaultPath}member/activeList&userId=${params.userId}&token=${params.token}&page=${params.page}&page_size=${params.page_size}`);
};
// 【学生/家长】我的评论
export const apiGetMyCommentList = params => {
  return request.get(`${defaultPath}member/myComment&userId=${params.userId}&token=${params.token}&page=${params.page}&page_size=${params.page_size}`);
};
// 发布活动
export const apiOrgPublish = params => {
  return request.post(`${defaultPath}member/publish`,params);
};
