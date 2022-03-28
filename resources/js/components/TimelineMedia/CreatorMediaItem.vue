<template>
  <!--    copy this div, change network and design accordingly.-->
  <div class="group justify-center" v-if="media.network == 'instagram'">
    <img
      :src="media.display_url"
      class="mx-auto aspect-square h-full justify-center object-cover object-center" />

    <div
      class="flex justify-between border-t border-b border-neutral-200 bg-neutral-200/20 px-6 py-0.5 text-center text-neutral-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
      <div class="inline-flex text-xs">
        <ThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.likes) }}
      </div>
      <div class="inline-flex text-xs">
        <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.views) }}
      </div>
      <div class="inline-flex text-xs">
        <ChatAlt2Icon class="mt-0.5 mr-0.5 h-3 w-3" />
        {{ formatCount(media.comments) }}
      </div>
    </div>
  </div>
</template>

<script>
import { ThumbUpIcon, PlayIcon, ChatAlt2Icon } from '@heroicons/vue/solid';

export default {
  name: 'CreatorMediaItem',
  components: {
    ThumbUpIcon,
    PlayIcon,
    ChatAlt2Icon,
  },
  props: {
    media: {
      required: true,
      type: Object,
    },
  },
};
</script>

<style scoped></style>
