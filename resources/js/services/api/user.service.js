import store from '../../store';

const baseUrl = process.env.APP_URL+'/api'
const baseUrlWeb = process.env.APP_URL

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
    }
}
