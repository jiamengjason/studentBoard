export const formatTime = date => {
  const year = date.getFullYear();
  const month = date.getMonth() + 1;
  const day = date.getDate();
  const hour = date.getHours();
  const minute = date.getMinutes();
  const second = date.getSeconds();

  return (
    [year, month, day].map(formatNumber).join("/") +
    " " +
    [hour, minute, second].map(formatNumber).join(":")
  );
};

export const isFunc = v => typeof v === "function";
export const isObject = v => v && typeof v === "object";
export const isPromise = obj => isObject(obj) && isFunc(obj.then);
export const hasPromise = obj =>
  isObject(obj) && Object.keys(obj).some(key => isPromise(obj[key]));
export const hasDeps = fn => getDeps(fn) !== null;

export const checkPhone = (rule, value, callback) => {
  const phoneReg = /^1[3|4|5|6|7|8][0-9]{9}$/;
  if (!value) {
    return callback(new Error("手机号码不能为空"));
  }
  setTimeout(() => {
    if (!Number.isInteger(+value)) {
      callback(new Error("请输入数字值"));
    } else {
      if (phoneReg.test(value)) {
        callback();
      } else {
        callback(new Error("手机号码格式不正确"));
      }
    }
  }, 100);
};
