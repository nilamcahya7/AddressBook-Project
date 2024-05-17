import { createRouter, createWebHistory } from "vue-router";

import home from '../components/home.vue'
import create from '../components/create.vue'
import index from '../components/index.vue'

const routes = [
  {
    path :'/',
    component : index
  },
  {
    path : '/create',
    component : create
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router