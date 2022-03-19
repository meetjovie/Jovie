import { watchEffect } from 'vue';
import router from "../router";
import store from "../store";

export const authenticationGuard = (to, from, next) => {

    store.dispatch('me').then(response => {
        return next()
    }).catch(() => {
        router.push({name: 'Login'})
    })

}
