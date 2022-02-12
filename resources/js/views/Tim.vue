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
        name: 'Tim White',
        verified: true,
        pic: '../img/External/timwhite.webp',
        link1: 'https://instagram.com/timwhite',
        link1icon: 'https://unpkg.com/simple-icons@v6/icons/instagram.svg',
        link2: 'https://twitter.com/itstimwhite',
        link2icon: 'https://unpkg.com/simple-icons@v6/icons/twitter.svg',
        link3: 'https://tiktok.com/@itstimwhite',
        link3icon: 'https://unpkg.com/simple-icons@v6/icons/tiktok.svg',
        link4: 'https://youtube.com/timwhite',
        link4icon: 'https://unpkg.com/simple-icons@v6/icons/youtube.svg',
        link5: 'https://open.spotify.com/artist/4Uwpa6zW3zzCSQvooQNksm',
        link5icon: 'https://unpkg.com/simple-icons@v6/icons/spotify.svg',
        link6: 'https://music.apple.com/us/artist/tim-white/859547284',
        link6icon: 'https://unpkg.com/simple-icons@v6/icons/apple.svg',
        ctalink: 'mailto:tim@jov.ie',
        ctatext: 'Email me',
        ctaicon: 'MailIcon',
        bio: 'Founder at',
        biolink: 'https://jov.ie',
        biolinktext: 'Jovie',
      },
    };
  },
};
</script>
