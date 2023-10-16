import { createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue'
import Overview from './components/Overview.vue'
import Reserve from './components/Reserve.vue'
import About from './components/About.vue'

const routes = [
  { path: '/', component: Welcome },
  { path: '/overview', component: Overview },
  { path: '/reserve', component: Reserve},
  { path: '/about', component: About}
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
