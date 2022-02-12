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
        name: 'Mackenzie',
        verified: false,
        pic: '../img/External/Mackenzie_Moore.webp',
        link1: 'https://instagram.com/mooremackenziel',
        link1icon: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
        link2: 'https://tiktok.com/@tallgirltruths',
        link2icon: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
        link3: 'https://www.linkedin.com/in/mackenzie-moore-1002a885/',
        link3icon: 'https://unpkg.com/simple-icons@v6/icons/linkedin.svg',
        ctalink: 'mailto:mackenziemoore.nyc@gmail.com',
        ctatext: 'Contact',
        ctaicon: 'https://unpkg.com/simple-icons@v6/icons/mail.svg',
        bio: 'Influencer Marketing Manager',
      },
    };
  },
};
</script>
