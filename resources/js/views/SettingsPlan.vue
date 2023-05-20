<template>
  <div>
    <SectionHeader header="Plan" subheader="Change or modify your plan" />
    <ActionPanel
      title="Manage billing"
      buttonText="Manage"
      :loading="loading"
      buttonStyle="primary"
      description="Manage your billing
    information"
      @action-click="stripePortal()" />
  </div>
</template>
<script>
import SectionHeader from './../components/SectionHeader.vue';
import ActionPanel from './../components/ActionPanel.vue';
import axios from 'axios';

export default {
  name: 'SettingsPlan',
  components: {
    SectionHeader,
    ActionPanel,
  },
  data() {
    return {
      loading: false,
    };
  },
  methods: {
    /* This is the method that we will use to create a Stripe portal session. */
    /*  async createCustomerPortalSession() {
      try {
        // Set request parameters
        const params = {
          customer: this.currentUser.currentTeam.stripe_id,
          return_url: 'https://jov.ie/settings/plan',
        };

        // Send POST request
        const response = await axios.post(
          '/create-customer-portal-session',
          params
        );

        // Redirect to the session URL
        window.location.href = response.data.url;
      } catch (error) {
        console.error(error);
        // Handle error here
        this.$notify({
          group: 'user',
          title: 'Error',
          text: error.message,
          type: 'error',
        });
      }
    }, */
    stripePortal() {
      this.loading = true;
      this.$notify({
        group: 'user',
        title: 'Redirecting',
        text: 'Redirecting to billing portal',
        type: 'success',
      });
      window.location.href =
        'https://billing.stripe.com/p/login/5kA3f39XJ68R1fq6oo';
      /*    createCustomerPortalSession(); */
    },
  },
};
</script>
