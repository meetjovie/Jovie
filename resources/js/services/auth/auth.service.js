import store from '../../store';

const baseApiUrl = '/api';

export default {
    async isLoggedIn() {
        return new Promise((resolve, reject) => {
            axios.get(`${baseApiUrl}/me`).then(response => {
               resolve(response)
            }).catch(error => {
                reject(error)
            })
        })
    },
    async login(data) {
        return new Promise((resolve, reject) => {
            axios.get('/sanctum/csrf-cookie').then(() => {
                axios.post(`${baseApiUrl}/login`, data).then(response => {
                    resolve(response)
                }).catch(error => {
                    reject(error)
                });
            });
        })
    },
    async logout() {
        return new Promise((resolve, reject) => {
            axios.post(`${baseApiUrl}/logout`).then(response => {
                resolve(response)
            }).catch(error => {
                reject(error)
            });
        })
    },
};
