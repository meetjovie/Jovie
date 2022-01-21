import Home from "./views/Home";

require('./bootstrap');

<<<<<<< HEAD
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import './index.css'
=======
import * as Vue from 'vue'
import * as VueRouter from 'vue-router'
import About from "./components/About";
>>>>>>> 3f28b6def37402bac23774a6f51aa7977dd311b7

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