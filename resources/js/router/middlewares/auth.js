import { useAuth0 } from "../../utils/useAuth0";
const { initAuth } = useAuth0();
import { watchEffect } from 'vue';
import router from "../index";
import store from "../../store";

export const authenticationGuard = (to, from, next) => {

    initAuth()

    const guardAction = () => {
        if (store.state.AuthState.isAuthenticated) {
            if (!from.name && to.path !== '/') {
                console.log('direct direct');
            }
            return next();
        }
        router.push({name: 'home'})
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
