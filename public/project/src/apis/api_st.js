import request from "./request";
const defaultPath = 'index.php?r='

// ----------------------------------机构相关---------------------------------------
// 获取机构列表
export const apiGetOrganizationList = params => {
  return request.get(`${defaultPath}organizations/index`, params);
};
// 获取机构详情
export const apiGetOrganizationInfo = params => {
  return request.get(`${defaultPath}organizations/detail&organization_id=${params.organization_id}`);
};
// 获取名师团队
export const apiGetFamousTeacher = params => {
    return request.get(`${defaultPath}organizations/famousTeacher&organization_id=${params.organization_id}`);
};
// 评价机构
export const apiDoValuate = params => {
  return request.post(`${defaultPath}member/evaluate`,params);
};
// 获取机构明星评价
export const apiGetOrgStartComment = params => {
  return request.get(`${defaultPath}organizations/startComment&organization_id=${params.organization_id}`);
};
// 获取机构全部评论
export const apiGetCommentListOrg = params => {
  return request.get(`${defaultPath}organizations/commentList&organization_id=${params.organization_id}`);
};
// ----------------------------------机构相关---------------------------------------


// ----------------------------------教师相关---------------------------------------
// 获取机构列表
export const apiGetTeachersList = params => {
  return request.get(`${defaultPath}teachers/index`, params);
};
// 获取详情
export const apigetTeachersInfo = params => {
    return request.get(`${defaultPath}teachers/info&teacher_id=${params.teacher_id}`);
};
// 获取相似教师
export const apiGetSimilarTeacher = params => {
  return request.get(`${defaultPath}teachers/similar&teacher_id=${params.teacher_id}`);
};
// 获取教师明星评价
export const apiGetTeacherStartComment = params => {
  return request.get(`${defaultPath}teachers/startComment&teacher_id=${params.teacher_id}`);
};
// 获取教师全部评论
export const apiGetCommentList = params => {
  return request.get(`${defaultPath}teachers/commentList&teacher_id=${params.teacher_id}`);
};
// ----------------------------------教师相关---------------------------------------

// ----------------------------------活动相关---------------------------------------
// 获取活动列表
export const apiGetActiveList = params => {
  return request.get(`${defaultPath}active/index`, params);
};
// 获取活动详细
export const apiGetActiveInfo = params => {
  return request.get(`${defaultPath}active/detail`, params);
};
// ----------------------------------活动相关---------------------------------------

// ----------------------------------留学生圈相关---------------------------------------
// 获取qa列表
export const apiQaList = params => {
  return request.get(`${defaultPath}qa/list`, params);
};

// ----------------------------------留学生圈相关---------------------------------------



// 点赞/踩
export const apiDoLikeDislike = params => {
  return request.get(`${defaultPath}comment/do`, params);
};

// 首页搜索
export const apiSearch = params => {
  return request.get(`${defaultPath}site/search`, params);
};