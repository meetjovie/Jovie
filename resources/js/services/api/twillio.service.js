import axios from 'axios';

const baseApiUrl = '/api';

export default {
  getOtp(data) {
    return axios.post(`${baseApiUrl}/get-otp`, data);
  },
  verifyOtp(data) {
    return axios.post(`${baseApiUrl}/verify-otp`, data);
  },
};
