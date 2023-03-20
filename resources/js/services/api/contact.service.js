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
};
