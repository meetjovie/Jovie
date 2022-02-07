import App from "./App.vue";

require('./bootstrap');

import * as Vue from 'vue'
import router from './router/index'
import store from './store/index'
const Vapor = require('laravel-vapor')

const myMixin = {

}

const app = Vue.createApp({})
app.mixin({
    methods: {
        asset(path) {
            return Vapor.asset(path)
        }
    }
})
app.use(router)
app.use(store)
app.component('App', App)
app.mount('#app')
