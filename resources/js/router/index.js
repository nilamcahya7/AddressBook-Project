import { createRouter, createWebHistory } from "vue-router";

import edit from '../components/edit.vue'
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
  },
  {
    name :'edit',
    path : '/edit/:id',
    component : edit
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router