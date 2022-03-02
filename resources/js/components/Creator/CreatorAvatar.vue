<template>
  <img
    class="aspect-square w-48 rounded-full border-4 border-neutral-400 object-cover object-center"
    :src="CreatorProfilePic"
    :alt="CreatorName" />
</template>
<script>
export default {
  name: 'CreatorAvatar',
  props: {
    CreatorProfilePic: {
      type: String,
      default: 'md',
    },
    CreatorName: {
      type: String,
      default: 'Creator Name',
    },
    Size: {
      type: String,
      default: 'md',
    },
  },
  data() {
    return {
      CreatorProfilePic: 'https://picsum.photos/200/300',
      CreatorName: 'John Doe',
    };
  },
};
</script>
