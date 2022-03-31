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
  async previousCreator(id) {
    return axios.get(`${baseApiUrl}/previous-creator/${id}`);
  },
  async nextCreator(id) {
    return axios.get(`${baseApiUrl}/next-creator/${id}`);
  },
  async updateOverviewCreator(data) {
    const id = data.id;
    delete data.id;
    return axios.post(
      `${baseApiUrl}/update-overview-creator/${id}?_method=PUT`,
      data
    );
  },
};
