import App from "./App.vue";

require('./bootstrap');

import * as Vue from 'vue'
import router from './router/index'
import store from './store/index'
window.Vapor = require('laravel-vapor')

const app = Vue.createApp({})
app.use(router)
app.use(store)
app.component('App', App)
app.mount('#app')
