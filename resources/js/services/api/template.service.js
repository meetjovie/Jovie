const baseApiUrl = '/api';

export default {
  getTemplates() {
    return axios.get(`${baseApiUrl}/templates`);
  },
  getSettings($userList) {
    return axios.get(`${baseApiUrl}/template-settings/${$userList}`);
  },
  updateSettings($userList, data) {
    return axios.post(`${baseApiUrl}/template-settings/${$userList}`, data);
  },
};
