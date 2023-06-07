export default {
  setStateChangeForAuth(state, payload) {
    Object.keys(payload).forEach((val) => {
      state.AuthState[val] = payload[val];
    });
  },
  setAuthStateUser(state, payload) {
    state.AuthState.user = payload;
  },
  setAddedToWaitList(state) {
    state.addedToWaitList = true;
  },
  setSidebarStatus(state, payload) {
    state.sidebarStatus = payload;
  },
  switchTeam(state, payload) {
    state.AuthState.user.current_team = payload;
  },
  toggleCRMSidebar(state) {
    state.CRMSidebarOpen = !state.CRMSidebarOpen;
    //save to local storage using vue
    localStorage.setItem('CRMSidebarOpen', state.CRMSidebarOpen);

    //log to console
    console.log('CRMSidebarOpen: ', state.CRMSidebarOpen);
  },
  toggleContactSidebar(state) {
    state.ContactSidebarOpen = !state.ContactSidebarOpen;
    //save to local storage
    window.localStorage.setItem('ContactSidebarOpen', state.ContactSidebarOpen);
    //log to console
    console.log('ContactSidebarOpen: ', state.ContactSidebarOpen);
  },
  setCrmRecords(state, payload) {
    state.crmRecords = payload;
  },
  setChromeExtensionInstalled(state, payload) {
    state.chromeExtensionInstalled = payload;
  },
  setShowCustomFieldModal(state, payload) {
    state.crmPage.showCustomFieldsModal = false;
    setTimeout(() => {
      state.crmPage.showCustomFieldsModal = true;
    }, 100);
  },
};
