<template>
  <CreatorProfile :profile="profile"></CreatorProfile>
</template>
<script>
import CreatorProfile from '../components/Creator/CreatorProfile.vue';

export default {
  components: {
    CreatorProfile,
  },
  data() {
    return {
      profile: {
        name: 'Haruki',
        verified: true,
        pic: '../img/External/haruki.webp',
        link1: 'https://www.youtube.com/channel/UCsEUAOux7YF2s5T1m95_Hig',
        link1icon: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
        link2:
          'https://twitter.com/8rukiii/?ltclid=861067f0-4f3a-488a-b692-4f4f2e8123bb',
        link2icon: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
        link3:
          'https://www.instagram.com/hr.8ruki/?ltclid=2a375d59-aa0b-4214-a0fe-97004d3488ec',
        link3icon: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
        ctalink: 'https://www.youtube.com/channel/UCsEUAOux7YF2s5T1m95_Hig',
        ctatext: 'Subscribe',
        ctaicon: 'MailIcon',
        bio: 'Video Creator',
        biolink: null,
        biolinktext: null,
      },
    };
  },
};
</script>
