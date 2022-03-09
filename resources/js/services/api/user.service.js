import store from '../../store';

const baseApiUrl = '/api';
const baseUrlWeb = '';
const baseUrlAdmin = '/api/admin';

export default {
    async me() {
        return axios.get(`${baseApiUrl}/me`);
    },
    async addToWaitList(data) {
        return axios.post(`${baseUrlWeb}/waitlist`, data);
    },
    async updateProfile(data) {
        return axios.post(`${baseApiUrl}/profile?_method=PUT`, data);
    },
    async removeProfilePhoto() {
        return axios.post(
            `${baseApiUrl}/remove-profile-photo?_method=DELETE`);
    },
    async getUserLists() {
        return axios.get(`${baseUrlAdmin}/user-lists`);
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
            responseType: 'blob'
        });
    },
    async updateCreator(data) {
        const id = data.id;
        delete data.id;
        return axios.post(
            `${baseUrlAdmin}/update-creator/${id}?_method=PUT`, data);
    },
    async getPublicProfile(data) {
        return axios.get(
            `${baseUrlWeb}/public-profiles/`, {
                params: data,
            }
        );
    }
};
