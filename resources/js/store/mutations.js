export default {
    setStateChangeForAuth(state, payload) {
        Object.keys(payload).forEach(val => {
            state.AuthState[val] = payload[val]
        })
    }
}
