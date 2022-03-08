import userService from "../services/api/user.service";
import AuthService from "../services/auth/auth.service";
import router from "../router";

export default {

    async logout(context) {
        AuthService.logout().then(response => {
            router.push({name: 'Login'})
        })
    },

    async me({state, commit}) {
        return new Promise((resolve, reject) => {
            userService.me().then(response => {
                response = response.data
                commit('setAuthStateUser', response)
                return resolve(response)
            }).catch(error => {
                commit('setAuthStateUser', null)
                return reject(error)
            })
        })
    },

    async updateCreator(context, payload) {
        return await userService.updateCreator(payload)
    },

    getPublicProfile(context, payload) {
        return new Promise((resolve, reject) => {
            userService.getPublicProfile(payload).then(response => {
                resolve(response.data)
            }).catch(error => {
                return reject(error)
            })
        })
    },
}
