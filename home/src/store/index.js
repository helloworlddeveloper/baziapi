import {createStore} from 'vuex'
import {post} from "@/utilis/request";
import createPersistedState from "vuex-persistedstate";

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
      usertype: '',
    },
    username: '',

    homeDesc: '',

    replyUserMessage: [],
    allMessage: [],

    isProgress: false,

    //tab
    currentTab: 'defaultMessage',
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
    },

    usernameMutations(state, v) {
      state.username = v
    },

    homeDescMutations(state, v) {
      state.homeDesc = v
    },

    replyUserMessageMutations(s, v) {
      s.replyUserMessage = v
    },
    allMessageMutations(s, v) {
      s.allMessage = v
    },

    isProgressMutations(s) {
      if (s.isProgress === false) {
        s.isProgress = true
      } else {
        s.isProgress = false
      }
    },

    //tab
    currentTabMutations(s, v) {
      s.currentTab = v
    },
  },

  actions: {
    //获取首页静态数据
    getHomeDesc({commit}) {
      post('getHome', {}, {})
        .then(response => {
          if (response.status === 200) {
            commit('homeDescMutations', response.data.data)
          }
        })
    },

    //按用户ID获取所有留言
    replyUserMessageActions({commit}, v) {
      commit('isProgressMutations', true)
      post('admin/' + v.methods, v.sendData, {
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('admin_access_token'),
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
        .then(response => {
          if (response.status === 200) {
            console.log(response.data);
            commit('isProgressMutations', false)

            //按用户ID排序
            if (v.methods === 'getMessageAll') {
              commit('replyUserMessageMutations', response.data.data)
              commit('currentTabMutations', 'fromAccId')
            }

            //所有最新留言
            if (v.methods === 'getMessageAllNew') {
              commit('allMessageMutations', response.data.data)
              commit('currentTabMutations', 'defaultMessage')
            }


            commit('alertMuta', {isShow: true, color: 'alert-success', icon: 'mdi-check-circle', message: response.data.message,})
            setTimeout(() => {
              commit('alertMuta', {isShow: false,})
            }, 3000)
          }
        })
        .catch(error => {
          commit('alertMuta', {isShow: true, color: 'alert-danger', icon: 'mdi-alert-decagram-outline', message: error,})
          commit('isProgressMutations', false)
          setTimeout(() => {
            commit('alertMuta', {
              isShow: false,
            })
          }, 3000)
        })
    }
  },

  modules: {},

  plugins: [createPersistedState({
    reducer(val) {
      return {
        homeDesc: val.homeDesc,
        replyUserMessage: val.replyUserMessage,
        currentTab: val.currentTab,
        allMessage: val.allMessage,
      }
    }
  })],
})
