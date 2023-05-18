import store from '../../store';
import axios from 'axios';
import router from "../../router";

const baseApiUrl = '/api';
const baseUrlWeb = '';

export default {
  async me(config, login) {
      if (config) {
          return axios.get(`${baseApiUrl}/me?login=${login ?? false}`, config);
      } else {
          console.log('234234');
          return axios.get(`${baseApiUrl}/me?login=${login ?? false}`);
      }
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
    getCrmContacts(data, cancelSignal = null) {
      let config = {
          params: data
      }
      if (cancelSignal) {
          config.signal = cancelSignal
      }
      return axios.get(`${baseApiUrl}/crm-contacts`, config);
  },
  getCrmContactByHandler(data, cancelSignal = null) {
      let config = {
          params: data
      }
      if (cancelSignal) {
          config.signal = cancelSignal
      }
      return axios.get(`${baseApiUrl}/get-extension-creator`, config);
  },
  async exportCrmContacts(data) {
    return axios.get(`${baseApiUrl}/export-crm-creators`, {
      params: data,
      responseType: 'blob',
    });
  },
  async updateContact(data) {
    const id = data.id;
    delete data.id;
    return axios.post(`${baseApiUrl}/update-contact/${id}`, data);
  },
  async getPublicProfile(data) {
    return axios.get(`${baseUrlWeb}/public-profiles/`, {
      params: data,
    });
  },
  async getContactOverview(data) {
    return axios.post(`${baseApiUrl}/contacts-overview`, data);
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
  async setPassword(data) {
    return axios.post(`${baseApiUrl}/set-password?_method=PUT`, data);
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
  async createList(data) {
    return axios.post(`${baseApiUrl}/create-list`, data);
  },
  async updateList(data, id) {
    return axios.post(`${baseApiUrl}/update-list/${id}?_method=PUT`, data);
  },
  async toggleContactsFromList(data) {
    return axios.post(`${baseApiUrl}/toggle-contacts-from-list`, data);
  },
  async toggleArchiveContacts(data) {
    return axios.post(`${baseApiUrl}/toggle-archive-contacts`, data);
  },
  crmCounts() {
    return axios.get(`${baseApiUrl}/crm-counts`);
  },
  uploadTempFileFromUrl(image) {
      return axios.get(`${baseApiUrl}/upload-temp-file?image_url=${image}`);
  },
  saveToCrm(data) {
      return axios.post(`${baseApiUrl}/save-to-crm`, data);
  },
  async sortFields(data, id) {
      return axios.post(`${baseApiUrl}/set-field-order/${id}`, data);
  },
  async sortHeaders(data, id) {
      return axios.post(`${baseApiUrl}/set-header-order/${id}`, data);
  },
  async toggleHeaderHide(data, id) {
     return axios.post(`${baseApiUrl}/toggle-header-hide/${id}`, data);
  },
  async deleteField(id) {
     return axios.delete(`${baseApiUrl}/custom-field/${id}/delete`);
  },
    async updateColumnWidth(data, id) {
        return axios.post(`${baseApiUrl}/set-header-width/${id}`, data);
    },
};
