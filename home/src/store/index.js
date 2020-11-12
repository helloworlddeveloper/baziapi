import {createStore} from 'vuex'

export default createStore({
  state: {
    alert: {
      color: '',
      message: '',
      isShow: false,
      icon: '',
    },
    message: {
      uid: '',
      username: '',
      usertype:'',
    }
  },
  mutations: {
    //Message
    alertMuta(state, payload) {
      state.alert.color = payload.color
      state.alert.message = payload.message
      state.alert.icon = payload.icon
      state.alert.isShow = payload.isShow
    },
    messageMutations(state, payload) {
      state.message.uid = payload.uid
      state.message.username = payload.username
      state.message.usertype = payload.usertype
    }
  },
  actions: {},
  modules: {}
})
