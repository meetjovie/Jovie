require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import './index.css'

const router = VueRouter.createRouter(routes)

const app = Vue.createApp({})

app.use(router)

app.mount('#app')