import Home from "./views/Home";

require('./bootstrap');

import * as Vue from 'vue'
import * as VueRouter from 'vue-router'
import About from "./components/About";

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
]
const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes
})

const app = Vue.createApp({})

app.use(router)

app.mount('#app')
