<template>
  <div>
    <!--sse-->
    <div
      v-if="iconstyle == 'vertical'"
      class="mt-1 grid grid-cols-6 items-center text-center">
      <div
        v-for="socialLink in socialLinks"
        :key="socialLink.id"
        @click="openLink(socialLink.url, true)"
        class="mx-auto cursor-pointer items-center justify-center">
        <template v-if="hasUrl(socialLink.url)">
          <div class="text-neutral-5 mx-auto justify-center text-center">
            <SocialIcons
              :height="'14px'"
              :iconstyle="iconstyle"
              :icon="socialLink.network" />
          </div>
          <div class="mx-auto text-center text-2xs text-neutral-500">
            v-if=socialLink.followers
            {{ formatCount(socialLink.followers) }}
          </div>
        </template>
      </div>
    </div>
    <div
      v-if="iconstyle == 'horizontal'"
      class="mx-auto mt-2 flex justify-start space-x-6">
      <div
        v-for="socialLink in socialLinks"
        :key="socialLink.id"
        @click="openLink(socialLink.url, true)"
        class="flex cursor-pointer">
        <template v-if="hasUrl(socialLink.url)">
          <SocialIcons
            :height="'14px'"
            :iconstyle="iconstyle"
            :icon="socialLink.network" />
          <span class="text-xs text-neutral-500" v-if="socialLink.followers">{{
            formatCount(socialLink.followers)
          }}</span>
        </template>
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
  methods: {
    hasUrl(url) {
      console.log(typeof url);
      if (typeof url == 'object') {
        if (Object.keys(url).length) {
          return true;
        } else {
          return false;
        }
      } else if (url) {
        return true;
      }
      return false;
    },
  },
};
</script>
