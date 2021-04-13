import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Buyers from "../views/Buyers.vue";
import Tickets from "../views/Tickets";
import RegisterBuyer from "../views/RegisterBuyer";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/buyers',
    name: 'Buyers',
    component: Buyers
  },
  {
    path: '/tickets',
    name: 'Tickets',
    component: Tickets
  },
  {
    path: '/register_buyer',
    name: 'RegisterBuyer',
    component: RegisterBuyer
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
