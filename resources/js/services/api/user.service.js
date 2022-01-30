import store from '../../store';

const baseUrl = 'https://cd6c-2400-adc7-91d-db00-c64e-3f3b-5dd8-7163.ngrok.io/api'
const headers = async () => {
    let token = await store.state.AuthState.auth0.getIdTokenClaims();
    token = token.__raw
    console.log('token');
    console.log(token);
    return { 'Authorization': `Bearer ${token}` };
};

export default {
    async me() {
        console.log('headers()');
        console.log(await headers());
        return axios.get(`${baseUrl}/me`, {
            headers: await headers()
        })
    }
}
