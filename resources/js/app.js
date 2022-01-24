import App from "./App";

require('./bootstrap');

import * as Vue from 'vue'
import router from './router/index'
import store from './store/index'

const app = Vue.createApp({})
app.use(router)
app.use(store)
app.component('App', App)
app.mount('#app')
