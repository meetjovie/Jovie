import { useAuth0 } from "../utils/useAuth0";
const { initAuth } = useAuth0();
import { watchEffect } from 'vue';
import router from "../router";
import store from "../store";

export const authenticationGuard = (to, from, next) => {

    initAuth()

    const guardAction = () => {
        if (process.env.MIX_IS_LOCAL === 'true') {
            console.log('hello');
            store.dispatch('me').then(() => {
                return next()
            })
        } else {
            if (store.state.AuthState.isAuthenticated) {
                // check if any url other than home url is hit directly
                // or if the localstorage user if null
                // we need to fetch the current info data from me api and only then move next
                if (!from.name && to.path !== '/' || !store.state.AuthState.user) {
                    store.dispatch('me').then(() => {
                        return next()
                    })
                } else {
                    return next();
                }
            } else {
                router.push({name: 'Home'})
            }
        }
    };

    // If the Auth0Plugin has loaded already, check the authentication state
    if (!store.state.AuthState.loading) {
        return guardAction();
    }

    // Watch for the loading property to change before we check isAuthenticated
    watchEffect(() => {
        if (store.state.AuthState.loading === false) {
            return guardAction();
        }
    })
}
