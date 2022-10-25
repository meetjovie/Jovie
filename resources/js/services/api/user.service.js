import store from '../../store';
import axios from 'axios';
import router from "../../router";

const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
  async me(config) {
    return axios.get(`${baseApiUrl}/me`, config);
  },
  async addToWaitList(data) {
    return axios.post(`${baseUrlWeb}/waitlist`, data);
  },
  async updateProfile(data) {
    return axios.post(`${baseApiUrl}/profile?_method=PUT`, data);
  },
  async removeProfilePhoto() {
    return axios.post(`${baseApiUrl}/remove-profile-photo?_method=DELETE`);
  },
  async getUserLists() {
    return axios.get(`${baseApiUrl}/user-lists`);
  },
  getCrmCreators(data, cancelSignal = null) {
      let config = {
          params: data
      }
      if (cancelSignal) {
          config.signal = cancelSignal
      }
      console.log('cancelSignal');
      console.log(config);
      return axios.get(`${baseApiUrl}/crm-creators`, config);
  },
  async exportCrmCreators(data) {
    return axios.get(`${baseApiUrl}/export-crm-creators`, {
      params: data,
      responseType: 'blob',
    });
  },
  async updateCreator(data) {
    const id = data.id;
    delete data.id;
    return axios.post(`${baseApiUrl}/update-creator/${id}?_method=PUT`, data);
  },
  async getPublicProfile(data) {
    return axios.get(`${baseUrlWeb}/public-profiles/`, {
      params: data,
    });
  },
  async getCreatorOverview(id) {
    return axios.get(`${baseApiUrl}/creators-overview/${id}`);
  },
  async subscribe(token, selectedPlan, selectedProduct, coupon) {
    return axios.post(`${baseApiUrl}/subscription`, {
      paymentMethod: token,
      selectedPlan: selectedPlan,
      selectedProduct: selectedProduct,
        coupon: coupon,
    });
  },
  async paymentIntent() {
    return axios.get(`${baseApiUrl}/payment-intent`);
  },
  async getSubscriptionProducts() {
    return axios.get(`${baseApiUrl}/subscription-products`);
  },
  async cancelSubscription() {
    return axios.post(`${baseApiUrl}/cancel-subscription`);
  },
  async resumeSubscription() {
    return axios.post(`${baseApiUrl}/resume-subscription`);
  },
  async changeSubscription(token, selectedPlan, selectedProduct, coupon) {
    return axios.post(`${baseApiUrl}/change-subscription`, {
      paymentMethod: token,
      selectedPlan: selectedPlan,
      selectedProduct: selectedProduct,
        coupon: coupon,
    });
  },
  buySeats(numberOfSeats) {
    return axios.post(`${baseApiUrl}/buy-seats`, {
      numberOfSeats: numberOfSeats,
    });
  },
  addCreatorToCrm(creatorId) {
    return axios.post(`${baseApiUrl}/add-to-crm`, { creator_id: creatorId });
  },
  async moveCreator(data) {
    const id = data.id;
    delete data.id;
    return axios.post(`${baseApiUrl}/move-creator/${id}?_method=PUT`, data);
  },
  async updatePassword(data) {
    return axios.post(`${baseApiUrl}/update-password?_method=PUT`, data);
  },
  async sendResetEmail(data) {
    return axios.post(`${baseApiUrl}/forgot-password`, data);
  },
  async resetPassword(data) {
    return axios.post(`${baseApiUrl}/reset-password`, data);
  },
  async sortLists(data, id) {
    return axios.post(`${baseApiUrl}/sort-user-lists/${id}`, data);
  },
  async pinList(id) {
    return axios.post(`${baseApiUrl}/pin-user-lists/${id}`);
  },
  async unpinList(id) {
    return axios.post(`${baseApiUrl}/unpin-user-lists/${id}`);
  },
  async duplicateList(id) {
    return axios.post(`${baseApiUrl}/duplicate-list/${id}`);
  },
  async deleteList(id) {
    return axios.post(`${baseApiUrl}/delete-list/${id}?_method=DELETE`);
  },
  async createList() {
    return axios.post(`${baseApiUrl}/create-list`);
  },
  async updateList(data, id) {
    return axios.post(`${baseApiUrl}/update-list/${id}?_method=PUT`, data);
  },
  async toggleCreatorsFromList(data) {
    return axios.post(`${baseApiUrl}/toggle-creators-from-list`, data);
  },
  async toggleArchiveCreators(data) {
    return axios.post(`${baseApiUrl}/toggle-archive-creators`, data);
  },
  crmCounts() {
    return axios.get(`${baseApiUrl}/crm-counts`);
  },
  updateCreatorNote(creatorId, note) {
    return axios.post(`${baseApiUrl}/update-creator-note/${creatorId}`, {note: note});
  },
  updateCrmMeta(crmId, meta) {
    return axios.post(`${baseApiUrl}/update-crm-meta/${crmId}`, {meta: meta});
  },
  uploadTempFileFromUrl(image) {
      return axios.get(`${baseApiUrl}/upload-temp-file?image_url=${image}`);
  },
  saveToCrm(data) {
      return axios.post(`${baseApiUrl}/save-to-crm`, data);
  },
};
