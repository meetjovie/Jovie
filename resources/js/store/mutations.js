export default {
    setStateChangeForAuth(state, payload) {
        Object.keys(payload).forEach(val => {
            state.AuthState[val] = payload[val]
        })
    },
    setAuthStateUser(state, payload) {
        state.AuthState.user = payload
        localStorage.setItem('currentUser', JSON.stringify(payload))
    }
}
