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
