<template>
  <div>
    <!--sse-->
    <div class="mx-auto mt-2 flex justify-start space-x-6">
      <div @click="openLink(socialLink.url, true)" class="flex cursor-pointer">
        <SocialIcons
          :height="'14px'"
          :iconstyle="iconstyle"
          :icon="socialLink.network" />
        <span class="text-xs text-slate-500" v-if="socialLink.followers">{{
          formatCount(socialLink.followers)
        }}</span>
      </div>
    </div>
    <!--/sse-->
  </div>
</template>
<script>
import SocialIcons from '../SocialIcons';

export default {
  components: { SocialIcons },
  props: {
    iconstyle: {
      type: String,
      default: 'horizontal',
    },
    socialLinks: {
      type: Array,
    },
  },
  data() {
    return {};
  },
};
</script>
