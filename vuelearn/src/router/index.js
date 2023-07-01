import { createRouter, createWebHistory } from 'vue-router'
import TaskEdit from '../views/TaskEdit.vue'
import Main from '../views/Main.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Main
  },
  {
    path: '/task-:id(\d+)',
    name: 'task-edit',
    component: TaskEdit,
    props: true
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
