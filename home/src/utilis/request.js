import axios from 'axios'

const instance = axios.create({
  // baseURL: 'http://data.com/api/',
  // baseURL: 'http://192.168.1.163/api/',
  baseURL: 'https://data.water555.xyz/api/',
  // timeout: 3000
  timeout: 60000
})

instance.interceptors.request.use(
  function (response) {
    return response
  },
  error => {
    return Promise.reject(error.response);
  }
)

instance.interceptors.response.use(
  function (response) {
    // console.group('全局请求响应',)
    // console.log(response);
    // console.groupEnd()
    if (response.status === 200) {
      return response
    } else {
      return '请求异常，请重试'
    }
  },
  error => {
    // console.group('全局错误响应')
    // console.warn(error.response)
    // console.groupEnd()
    let errors = error + ''
    //网络不通弹窗
    if (errors === 'Error: Network Error' || error === '' || error === 'undefined') {
      return Promise.reject(errors);
    }
    if (error.response.status === 401) {
      return Promise.reject(error.response.data.message);
    }
    if (error.response.status === 403) {
      return Promise.reject(error.response.data.message);
    }
    if (error.response.status === 405) {
      return Promise.reject(error.response.data.message);
    }
    if (error.response.status === 422) {
      return Promise.reject(Object.values(error.response.data.errors)[0][0]);
    }
    if (error.response.status === 429) {
      window.location.href = window.location.host
      localStorage.clear()
      return Promise.reject('禁止频繁操作！请休息几分钟，然后重新登陆。');
    }
    if (error.response.status === 500) {
      return Promise.reject('服务器错误，请重试。');
    }
    if (error.code === 'ECONNABORTED' && error.message.indexOf('timeout') !== -1) {
      return Promise.reject('请求超时，请重试，或检查网络。');
    }
    return Promise.reject(error.response);
  }
)

export function get(url, params) {
  return instance.get((url, {
    params
  }))
}

export function post(url, data, config) {
  return instance.post(url, data, config)
}