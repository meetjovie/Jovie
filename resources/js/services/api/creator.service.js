
const baseApiUrl = '/api';
const baseUrlWeb = '';
const baseUrlAdmin = '/api/admin';

export default {
    getComments(creatorId, limit) {
        return axios.get(`${baseUrlAdmin}/get-comments/${creatorId}?limit=${limit}`);
    },
    async addComment(data) {
        return axios.post(`${baseUrlAdmin}/add-comment`, data);
    },
}
