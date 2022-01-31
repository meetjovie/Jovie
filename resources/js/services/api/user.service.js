import store from '../../store';

const baseUrl = 'https://8ca1-2400-adc7-91d-db00-3777-5482-8064-1d0f.ngrok.io/api'
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
    }
}
