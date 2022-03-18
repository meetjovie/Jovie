export default {
    setStateChangeForAuth(state, payload) {
        Object.keys(payload).forEach(val => {
            state.AuthState[val] = payload[val]
        })
    },
    setAuthStateUser(state, payload) {
        state.AuthState.user = payload
    },
    setAddedToWaitList(state) {
        state.addedToWaitList = true
    },
    switchTeam(state, payload) {
        state.AuthState.user.current_team = payload
    }
}
