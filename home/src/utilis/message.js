import store from './../store'

export default {
  install: (app) => {
    app.config.globalProperties.$message = (type, msg) => {
      if (store.state.alert.isShow === true) {
        store.commit('alertMuta', {isShow: false})
      }
      setTimeout(() => {
        switch (type) {
          case "success":
            store.commit('alertMuta', {
              isShow: true,
              color: 'alert-success',
              icon: 'mdi-check-circle',
              message: msg,
            })
            break
          case "error":
            store.commit('alertMuta', {
              isShow: true,
              color: 'alert-danger',
              icon: 'mdi-alert-decagram-outline',
              message: msg,
            })
            break
          case "warning":
            store.commit('alertMuta', {
              isShow: true,
              color: 'alert-warning',
              icon: 'mdi-shield-alert',
              message: msg,
            })
            break
          case "info":
            store.commit('alertMuta', {
              isShow: true,
              color: 'alert-dark',
              icon: 'mdi-information-outline',
              message: msg,
            })
            break
        }
      }, 300)
      setTimeout(() => {
        store.commit('alertMuta', {
          isShow: false,
        })
      }, 3000)
    }
  }
}