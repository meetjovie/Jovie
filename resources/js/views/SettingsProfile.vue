<template>
  <div>
    <SectionHeader header="Profile" subheader="Edit your user profile" />
    <AccountProfile />
    <ActionPanel
      v-if="!onboarding"
      title="Delete Account"
      buttonStyle="danger"
      description="This is permanent and cannot be undone."
      buttonText="Delete"
      @action-click="toggleDeleteModal()" />
    <ModalPopup
      @primaryButtonClick="deleteAccount()"
      :open="deleteModalOpen"
      title="Deactivate account" />
  </div>
</template>
<script>
import SectionHeader from './../components/SectionHeader.vue';
import SectionWrapper from './../components/SectionWrapper.vue';
import AccountProfile from './../components/Account/AccountProfile.vue';
import ModalPopup from '../components/ModalPopup.vue';
import ActionPanel from '../components/ActionPanel.vue';
export default {
  name: 'SettingsProfile',
  data() {
    return {
      deleteModalOpen: false,
    };
  },
  methods: {
    deleteAccount() {
      console.log('deleteAccount');
      this.$notify({
        group: 'user',
        type: 'success',
        title: 'Deleting account',
        text: 'This may take a few minutes.',
      });
      //add a function to cancel users current billing plan
      //add a function to logout the user
      //redirect user to the homepage
      this.$router.push('/');
    },
    toggleDeleteModal() {
      this.deleteModalOpen = !this.deleteModalOpen;
    },
  },
  components: {
    SectionHeader,
    SectionWrapper,
    AccountProfile,
    ModalPopup,
    ActionPanel,
  },
};
</script>
