import { createRouter, createWebHistory } from 'vue-router'
import Welcome from './components/Welcome.vue'
import Overview from './components/Overview.vue'
import Reserve from './components/Reserve.vue'
import About from './components/About.vue'

import Confirm from './components/ReserveComponents/Confirm.vue'
import Details from './components/ReserveComponents/Details.vue'
import Payment from './components/ReserveComponents/Payment.vue'



const routes = [
  { path: '/', component: Welcome },
  { path: '/overview', component: Overview },
  { path: '/about', component: About },
  { 
    path: '/reserve', 
    component: Reserve,
    children: [
      { path: '', redirect: '/reserve/details' },  // Aggiungi questa riga
      { path: 'details', component: Details },
      { path: 'payment', component: Payment },
      { path: 'confirm', component: Confirm }
    ]
  }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
