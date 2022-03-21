const baseApiUrl = '/api';
const baseUrlWeb = '';
const baseUrlAdmin = '/api/admin';

export default {
  getComments(creatorId, limit) {
    return axios.get(
      `${baseUrlAdmin}/get-comments/${creatorId}?limit=${limit}`
    );
  },
  async addComment(data) {
    return axios.post(`${baseUrlAdmin}/add-comment`, data);
  },
  async previousCreator(id) {
    return axios.get(`${baseUrlAdmin}/previous-creator/${id}`);
  },
  async nextCreator(id) {
    return axios.get(`${baseUrlAdmin}/next-creator/${id}`);
  },
  async updateOverviewCreator(data) {
    const id = data.id;
    delete data.id;
    return axios.post(
      `${baseUrlAdmin}/update-overview-creator/${id}?_method=PUT`,
      data
    );
  },
};
