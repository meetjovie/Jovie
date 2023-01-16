const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
    getFields() {
        return axios.get(
            `${baseApiUrl}/fields`
        );
    },
}
