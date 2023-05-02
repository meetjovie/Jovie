const baseApiUrl = '/api';

export default {
  getSettings($userList) {
    return axios.get(`${baseApiUrl}/template-settings/${$userList}`);
  },
};
