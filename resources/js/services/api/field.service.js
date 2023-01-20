const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
    getFields() {
        return axios.get(
            `${baseApiUrl}/fields`
        );
    },
    getCustomFieldTypes() {
        return axios.get(
            `${baseApiUrl}/custom-field-types`
        );
    },
    saveCustomField(data) {
        return axios.post(
            `${baseApiUrl}/custom-field`, data
        );
    },
}
