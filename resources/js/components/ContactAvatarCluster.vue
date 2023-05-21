<template>
  <div class="flex -space-x-1 overflow-hidden px-2 py-1">
    <ContactAvatar
      v-for="(contact, index) in contacts.slice(0, 5)"
      :key="index"
      :editable="false"
      :height="8"
      :contact="contact" />
  </div>
</template>
<script>
import ContactAvatar from './ContactAvatar.vue';
export default {
  components: {
    ContactAvatar,
  },
  props: {
    contacts: {
      type: Object,
      required: true,
    },
    editable: {
      type: Boolean,
      required: false,
      default: false,
    },
    height: {
      type: Number,
      required: false,
      default: 24,
    },
  },
};
</script>
