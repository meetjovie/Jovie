const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
  getSettings($userList) {
    return axios.get(`${baseApiUrl}/template-settings/${$userList}`);
  },
};
