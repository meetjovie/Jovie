<template>
  <div>
    <div
      v-if="iconstyle == 'vertical'"
      class="mt-1 grid grid-cols-6 items-center text-center">
      <div
        v-for="sociallink in sociallinks"
        :key="sociallink.id"
        class="mx-auto items-center justify-center">
        <div class="text-neutral-5 mx-auto justify-center text-center">
          <img height="12" width="12" class="mx-auto" :src="sociallink.url" />
        </div>
        <div class="mx-auto text-center text-2xs text-neutral-500">
          {{ sociallink.followers }}
        </div>
      </div>
    </div>
    <div
      v-if="iconstyle == 'horizontal'"
      class="mx-auto mt-2 flex justify-start space-x-6">
      <div v-for="sociallink in sociallinks" :key="sociallink.id" class="flex">
        <img
          height="14"
          width="14"
          class="z-0 mx-auto mr-1 opacity-50"
          :src="sociallink.url" />

        <span class="text-xs text-neutral-500">{{ sociallink.followers }}</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    iconstyle: {
      type: String,
      default: 'horizontal',
    },
  },
  data() {
    return {
      sociallinks: [
        {
          id: 1,
          url: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
          followers: '800K',
        },
        {
          id: 2,
          url: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
          followers: '72K',
        },
        {
          id: 3,
          url: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
          followers: '104K',
        },
        {
          id: 4,
          url: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
          followers: '22M',
        },
        {
          id: 5,
          url: 'https://unpkg.com/simple-icons@v6/icons/snapchat.svg',
          followers: '1.2M',
        },
        {
          id: 6,
          url: 'https://unpkg.com/simple-icons@v6/icons/onlyfans.svg',
          followers: '10K',
        },
      ],
    };
  },
};
</script>
