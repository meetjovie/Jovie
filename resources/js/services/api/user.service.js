import store from '../../store';

const baseUrl = '/api'
const baseUrlWeb = ''

const headers = async () => {
    let token = await store.state.AuthState.auth0.getIdTokenClaims();
    token = token.__raw
    return { 'Authorization': `Bearer ${token}` };
};

export default {
    async me() {
        return axios.get(`${baseUrl}/me`, {
            headers: await headers()
        })
    },
    async addToWaitList(data) {
        return axios.post(`${baseUrlWeb}/waitlist`, data)
    },
    async updateProfile(data) {
        return axios.post(`${baseUrl}/profile?_method=PUT`, data, {
            headers: await headers()
        })
    },
    async removeProfilePhoto() {
        return axios.post(`${baseUrl}/remove-profile-photo?_method=DELETE`, {}, {
            headers: await headers()
        })
    }
}
