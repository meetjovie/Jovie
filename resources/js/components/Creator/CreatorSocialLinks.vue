<template>
  <div class="mt-1 grid grid-cols-6 items-center text-center">
    <div
      v-for="sociallink in sociallinks"
      :key="sociallink"
      class="mx-auto items-center justify-center">
      <div class="text-neutral-5 mx-auto justify-center text-center">
        <img height="12" width="12" class="mx-auto" :src="sociallink.url" />
      </div>
      <div class="mx-auto text-center text-2xs text-neutral-500">
        {{ sociallink.followers }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      sociallinks: [
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
          followers: '800K',
        },
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
          followers: '72K',
        },
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
          followers: '104K',
        },
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
          followers: '22M',
        },
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/snapchat.svg',
          followers: '1.2M',
        },
        {
          url: 'https://unpkg.com/simple-icons@v6/icons/onlyfans.svg',
          followers: '10K',
        },
      ],
    };
  },
};
</script>
