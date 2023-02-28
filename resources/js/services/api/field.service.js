const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
    getFields(creatorId) {
        return axios.get(
            `${baseApiUrl}/fields/${creatorId}`
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
    updateCustomField(data) {
        return axios.put(
            `${baseApiUrl}/custom-field/${data.id}`, data
        );
    },
    getHeaderFields(listId) {
        return axios.get(
            `${baseApiUrl}/header-fields/${listId}`
        );
    },
}
