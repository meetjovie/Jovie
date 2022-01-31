import store from '../../store';

const baseUrl = 'http://127.0.0.1:8000/api'
const baseUrlWeb = 'http://127.0.0.1:8000'

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
    addToWaitList(data) {
        return axios.post(`${baseUrlWeb}/waitlist`, data)
    }
}
