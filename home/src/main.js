import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import message from "@/utilis/message";
import Message from "@/common/Message";
import log from "@/utilis/log";

const app = createApp(App)
app.use(message)
app.use(log)
app.component('Message', Message)

router.beforeEach((to, from, next) => {
  /* 路由发生变化修改页面title */
  if (to.meta.title) {
    document.title = to.meta.title
  } else {
    next()
  }
  //判断页面是否有权访问
  if (to.meta.requiresAuth) {
    if (localStorage.getItem('admin_access_token') || localStorage.getItem('admin_access_token') === 'null') {
      next()
    } else {
      next({
        path: '/',
        redirect: {name: 'Login'}
      })
    }
  } else {
    next()
  }
})

app
  .use(store)
  .use(router)
  .mount('#app')
