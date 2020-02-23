import request from "./request";

//post
export const apiPost = params => request.post(`/token`, params);
// get
export const apiGet = params => {
  return request.get(
    `/organization/members?school_id=${params.school_id}&role_id=${params.role_id}`
  );
};
