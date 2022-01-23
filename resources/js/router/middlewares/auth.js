import { useAuth0, AuthState } from "../../utils/useAuth0";
const { initAuth } = useAuth0(AuthState);
import { watchEffect } from 'vue';
import router from "../index";

export const authenticationGuard = (to, from, next) => {

    initAuth()

    const guardAction = () => {
        if (AuthState.isAuthenticated) {
            return next();
        }
        router.push({name: 'home'})
    };

    // If the Auth0Plugin has loaded already, check the authentication state
    if (!AuthState.loading) {
        return guardAction();
    }

    // Watch for the loading property to change before we check isAuthenticated
    watchEffect(() => {
        if (AuthState.loading === false) {
            return guardAction();
        }
    })
}
