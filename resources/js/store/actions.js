export default {
    async handleStateChangeForAuth(context) {
        context.commit('setStateChangeForAuth', {
            isAuthenticated: !!(await context.state.AuthState.auth0.isAuthenticated()),
            user: await context.AuthState.auth0.getUser(),
            loading: false
        })
    },
    async login(context) {
        await context.state.AuthState.auth0.loginWithPopup();
        await context.commit('handleStateChangeForAuth')
    },
    async logout(context) {
        context.state.AuthState.auth0.logout({
            returnTo: window.location.origin,
        });
    },
}
