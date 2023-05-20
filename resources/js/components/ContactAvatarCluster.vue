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
  data() {
    return {
      contacts: [
        {
          name: 'Jane Cooper',
          profile_pic_url:
            'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        {
          name: 'Kendall Jenner',
          profile_pic_url:
            'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        {
          name: 'Jessica Alba',
          profile_pic_url:
            'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80',
        },
      ],
    };
  },
  props: {
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
