export const formatTime = date => {
  const year = date.getFullYear()
  const month = date.getMonth() + 1
  const day = date.getDate()
  const hour = date.getHours()
  const minute = date.getMinutes()
  const second = date.getSeconds()

  return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

export const formatNumber = n => {
  n = n.toString()
  return n[1] ? n : '0' + n
}

export const checkFlash = () => {
  var isIE = navigator.appVersion.indexOf('MSIE') >= 0
  var hasFlash = true

  if (isIE) {
    try {
      var objFlash = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')
    } catch (e) {
      hasFlash = false
    }
  } else {
    if (!navigator.plugins['Shockwave Flash']) {
      hasFlash = false
    }
  }
  return hasFlash
}

export const flashTip = domId => {
  var tip = '<div class="flashtip" sytle=""><p>您还没有安装flash播放器,请点击<a href="http://www.adobe.com/go/getflash" target="_blank">这里</a>安装</p></div>'
  if (!checkFlash()) {
    $(domId).append(tip)
  }
}

export const isFunc = v => typeof v === 'function'
export const isObject = v => v && typeof v === 'object'
export const isPromise = obj => isObject(obj) && isFunc(obj.then)
export const hasPromise = obj => isObject(obj) && Object.keys(obj).some(key => isPromise(obj[key]))
export const hasDeps = fn => getDeps(fn) !== null
