const baseApiUrl = '/api';

export default {
  getSettings($userList) {
    return axios.get(`${baseApiUrl}/template-settings/${$userList}`);
  },
  updateSettings($userList, data) {
    return axios.post(`${baseApiUrl}/template-settings/${$userList}`, data);
  },
};
