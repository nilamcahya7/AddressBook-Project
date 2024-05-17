import { createRouter, createWebHistory } from "vue-router";

import home from '../components/home.vue'
import about from '../components/about.vue'

const routes = [
  {
    path :'/',
    component : home
  },
  {
    path : '/about',
    component : about
  }
]

const router = createRouter({
  history: createWebHistory(),
  linkExactActiveClass : 'active',
  routes
})

export default router