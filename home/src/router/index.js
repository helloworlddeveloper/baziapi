import {createRouter, createWebHistory} from 'vue-router'
import Login from "@/views/Login";

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
    meta: {
      title: 'Manage Login',
      keepAlive: true,
      requiresAuth: false
    }
  },
  {
    path: '/home',
    name: 'Home',
    component: () => import('@/views/Home'),
    meta: {
      title: 'Manage',
      keepAlive: true,
      requiresAuth: true,
    },
    children: [
      {
        path: '/user',
        name: 'userData',
        component: () => import('@/components/userData'),
        meta: {
          title: 'User-Manage',
          keepAlive: true,
          requireAuth: true
        }
      },
      {
        path: '/mingpan',
        name: 'mingpanData',
        component: () => import('@/components/mingpanData'),
        meta: {
          title: 'MingPan-Manage',
          keepAlive: true,
          requireAuth: true
        }
      },
      {
        path: '/pushInfo',
        name: 'pushInfo',
        component: () => import('@/components/pushInfo'),
        meta: {
          title: 'PushInfo-Manage',
          keepAlive: true,
          requireAuth: true
        }
      },
    ],
  },
  {
    path: '/test',
    name: 'Test',
    component: () => import('@/views/Test'),
    meta: {
      title: 'Test',
      keepAlive: true,
      requireAuth: false
    }
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/'
  },
]

const router = createRouter({
  // history: createWebHashHistory(),
  history: createWebHistory(),
  routes
})

export default router
