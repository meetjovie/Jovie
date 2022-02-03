export default {
    getCurrentUser (state) {
        return state.AuthState.user;
    },
    getAsset: (state) => (path) => {
        return window.Vapor.asset(path)
    }
}
