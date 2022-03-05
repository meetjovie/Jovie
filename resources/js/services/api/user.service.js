import store from '../../store';

const baseUrl = '/api';
const baseUrlWeb = '';
const baseUrlAdmin = '/api/admin';

export default {
    async me() {
        return axios.get(`${baseUrl}/me`, {
            headers: await store.dispatch('headers'),
        });
    },
    async addToWaitList(data) {
        return axios.post(`${baseUrlWeb}/waitlist`, data);
    },
    async updateProfile(data) {
        return axios.post(`${baseUrl}/profile?_method=PUT`, data, {
            headers: await store.dispatch('headers'),
        });
    },
    async removeProfilePhoto() {
        return axios.post(
            `${baseUrl}/remove-profile-photo?_method=DELETE`,
            {},
            {
                headers: await store.dispatch('headers'),
            }
        );
    },
    async getUserLists() {
        return axios.get(`${baseUrlAdmin}/user-lists`, {
            headers: await store.dispatch('headers'),
        });
    },
    async getCrmCreators(data) {
        return axios.get(`${baseUrlAdmin}/crm-creators`, {
            params: data,
            headers: await store.dispatch('headers'),
        });
    },
    async exportCrmCreators(data) {
        return axios.get(`${baseUrlAdmin}/export-crm-creators`, {
            params: data,
            headers: await store.dispatch('headers'),
            responseType: 'blob'
        });
    },
    async updateCreator(data) {
        const id = data.id;
        delete data.id;
        return axios.post(
            `${baseUrlAdmin}/update-creator/${id}?_method=PUT`,
            data,
            {
                headers: await store.dispatch('headers'),
            }
        );
    },
    async getPublicProfile(data) {
        return axios.get(
            `${baseUrlWeb}/public-profiles/`, {
                params: data,
                headers: await store.dispatch('headers'),
            }
        );
    }
};
