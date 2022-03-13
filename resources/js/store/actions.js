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

    async updateCreator(context, { id, index, network, key, value }) {
        const data = {
            id: id,
        };
        let keySplits = key.split('.');
        if (keySplits.length > 1) {
            var key1 = keySplits[0];
            var key2 = keySplits[1];
            data[key1] = {
                [key2]: value,
            };
        } else if (key == 'emails') {
            if (typeof value == 'string') {
                value = value.split(',')
                data[key] = value;
            }
        } else {
            data[key] = value;
        }
        return await userService.updateCreator(data)
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
