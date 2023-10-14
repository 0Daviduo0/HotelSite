import { createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue'
import Overview from './components/Overview.vue'

const routes = [
  { path: '/', component: Welcome },
  { path: '/overview', component: Overview }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
