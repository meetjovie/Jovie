<template>
  <CardLayout>
    <CardHeading
      title="Delete Account"
      subtitle="This is permanent and cannot be undone."
      buttonstyle="danger"
      @buttonClick="toggleDeleteModal()"
      buttontext="Delete">
    </CardHeading>
  </CardLayout>
</template>
<script>
import CardLayout from '../../components/CardLayout.vue';
import CardHeading from '../../components/CardHeading.vue';

export default {
  components: {
    CardLayout,
    CardHeading,
  },
  data() {
    return {
      deleteModal: false,
    };
  },
  methods: {
    toggleDeleteModal() {
      this.deleteModal = !this.deleteModal;
    },
  },
};
</script>
