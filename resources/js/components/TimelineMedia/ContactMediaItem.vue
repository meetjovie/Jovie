<template>
  <!--    copy this div, change network and design accordingly.-->
  <div class="group justify-center" v-if="media.network == 'instagram'">
    <img
      :src="media.display_url"
      class="mx-auto aspect-square h-full justify-center object-cover object-center" />

    <div
      class="flex justify-between border-t border-b border-slate-200 bg-slate-200/20 px-6 py-0.5 text-center text-slate-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
      <div class="inline-flex text-xs">
        <HandThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.likes) }}
      </div>
      <div class="inline-flex text-xs">
        <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.views) }}
      </div>
      <div class="inline-flex text-xs">
        <ChatBubbleBottomCenterIcon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.comments) }}
      </div>
    </div>
  </div>
</template>

<script>
import {
  HandThumbUpIcon,
  PlayIcon,
  ChatBubbleBottomCenterIcon,
} from '@heroicons/vue/24/solid';

export default {
  name: 'ContactMediaItem',
  components: {
    HandThumbUpIcon,
    PlayIcon,
    ChatBubbleBottomCenterIcon,
  },
  props: {
    media: {
      required: true,
      type: Object,
    },
  },
    mounted() {
        console.log('this.media');
        console.log(this.media);
    }
};
</script>

<style scoped></style>
