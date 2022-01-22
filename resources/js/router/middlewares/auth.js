import { useAuth0 } from "../../utils/useAuth0";
const { initAuth } = useAuth0(this.$store.state.AuthState);

export const authenticationGuard = (to, from, next) => {

    initAuth()
    const guardAction = () => {
        if (this.$store.state.AuthState.isAuthenticated) {
            return next();
        }
        this.$store.state.AuthState.loginWithRedirect({appState: {targetUrl: to.fullPath}});
    };

    // If the Auth0Plugin has loaded already, check the authentication state
    if (!this.$store.state.AuthState.loading) {
        return guardAction();
    }

    this.$store.state.AuthState.$watch('loading', (isLoading) => {
        if (isLoading === false) {
            return guardAction();
        }
    });
}
