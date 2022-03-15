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
        },
        unSlugify(value) {
            return value.toString().replaceAll('_', ' ')
        },
        formatCount(value) {
            value = value ? value : 0;
            if (value < 1000) {
                return value.toFixed(0)
            } else if (value >= 1000 && value < 999999) {
                return (value / 1000).toFixed(0) + 'K'
            } else if (value >= 1000000 && value < 999999999) {
                return (value / 1000000).toFixed(0) + 'M'
            } else if (value >= 1000000000 && value < 999999999999) {
                return (value / 1000000000).toFixed(0) + 'B'
            }
        }
    }
})
app.use(router)
app.use(store)
app.component('App', App)
app.mount('#app')
