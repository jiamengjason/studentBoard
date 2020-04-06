import request from "./request";
const defaultPath = 'index.php?r='

// ----------------------------------机构相关---------------------------------------
// 获取机构详情
export const apiGetOrganizationInfo = params => {
  return request.get(`${defaultPath}organizations/detail&organization_id=${params.organization_id}`);
};
// 获取名师团队
export const apiGetFamousTeacher = params => {
    return request.get(`${defaultPath}organizations/famousTeacher&organization_id=${params.organization_id}`);
};
// ----------------------------------机构相关---------------------------------------


// ----------------------------------教师相关---------------------------------------
// 获取详情
export const apigetTeachersInfo = params => {
    return request.get(`${defaultPath}teachers/info&teacher_id=${params.teacher_id}`);
};
// 获取相似教师
export const apiGetSimilarTeacher = params => {
  return request.get(`${defaultPath}teachers/similar&teacher_id=${params.teacher_id}`);
};
// ----------------------------------教师相关---------------------------------------
