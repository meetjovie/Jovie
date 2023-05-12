const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
    getComments(creatorId, limit) {
        return axios.get(
            `${baseApiUrl}/get-comments/${creatorId}?limit=${limit}`
        );
    },
    async addComment(data) {
        return axios.post(`${baseApiUrl}/add-comment`, data);
    },
    async previousContact(id) {
        return axios.get(`${baseApiUrl}/previous-contact/${id}`);
    },
    async nextContact(id) {
        return axios.get(`${baseApiUrl}/next-contact/${id}`);
    },
    async markEnrichedViewed(id) {
        return axios.post(`${baseApiUrl}/mark-enriched-viewed/${id}`);
    },
    async updateOverviewContact(data) {
        const id = data.id;
        delete data.id;
        return axios.post(
            `${baseApiUrl}/update-overview-creator/${id}?_method=PUT`,
            data
        );
    },
    checkContactsEnrichable(ids) {
        return axios.post(
            `${baseApiUrl}/check-contacts-enrichable`,
            {contact_ids: ids}
        );
    },
    enrichContacts(ids) {
        return axios.post(
            `${baseApiUrl}/enrich-contacts/`,
            {contact_ids: ids}
        );
    },
    checkListsEnrichable(ids) {
        return axios.post(
            `${baseApiUrl}/check-lists-enrichable`,
            {list_ids: ids}
        );
    },
    enrichLists(ids) {
        return axios.post(
            `${baseApiUrl}/enrich-lists/`,
            {list_ids: ids}
        );
    },
    getContactChangeLog(id, page) {
        return axios.get(
            `${baseApiUrl}/contact-change-log/${id}?page=${page}`);
    },
    suggestMerge(data = {}) {
        return axios.post(
            `${baseApiUrl}/suggest-merge`, data);
    },
    mergeContacts(data) {
        return axios.post(
            `${baseApiUrl}/merge-contacts`, data);
    }
};
