<template>
  <div class="flex">
    <div class="group justify-center">
      <img
        src="https://picsum.photos/220/300"
        class="mx-auto aspect-square h-full justify-center object-cover object-center" />

      <div
        class="flex justify-between border-t border-b border-gray-200 bg-gray-200/20 px-6 py-0.5 text-center text-gray-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
        <div class="inline-flex text-xs">
          <HandThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <ChatBubbleBottomCenterIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
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
  name: 'CreatorContentBar',
  components: {
    HandThumbUpIcon,
    PlayIcon,
    ChatBubbleBottomCenterIcon,
  },
};
</script>
