import userService from "../services/api/user.service";

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
    async me({state, commit}) {
        userService.me().then(response => {
            response = response.data
            commit('setAuthStateUser', response)
            return Promise.resolve(response)
        }).catch(error => {
            commit('setAuthStateUser', null)
        })
    }
}
