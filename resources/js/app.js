require('./bootstrap');

import * as Vue from 'vue'
import router from './router/index'

const app = Vue.createApp({})

app.use(router)

app.mount('#app')
