<template>
  <div>
    <div class="group grid grid-cols-3 justify-center">
      <img
        src="https://picsum.photos/220/300"
        class="mx-auto aspect-square h-full justify-center object-cover object-center" />
      <img
        src="https://picsum.photos/240/300"
        class="mx-auto aspect-square h-full justify-center object-cover object-center" />
      <img
        src="https://picsum.photos/230/300"
        class="mx-auto aspect-square h-full justify-center object-cover object-center" />
    </div>
    <div class="group mx-auto grid grid-cols-3 justify-center">
      <div
        class="flex justify-between border-t border-b border-neutral-200 bg-neutral-200/20 px-6 py-0.5 text-center text-neutral-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
        <div class="inline-flex text-xs">
          <ThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <ChatAlt2Icon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
      </div>
      <div
        class="flex justify-between border-t border-b border-neutral-200 bg-neutral-200/20 px-6 py-0.5 text-center text-neutral-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
        <div class="inline-flex text-xs">
          <ThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <ChatAlt2Icon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
      </div>
      <div
        class="flex justify-between border-t border-b border-neutral-200 bg-neutral-200/20 px-6 py-0.5 text-center text-neutral-700 backdrop-blur-xl backdrop-saturate-150 backdrop-filter">
        <div class="inline-flex text-xs">
          <ThumbUpIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <PlayIcon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
        <div class="inline-flex text-xs">
          <ChatAlt2Icon class="mt-0.5 mr-0.5 h-3 w-3" /> 34K
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ThumbUpIcon, PlayIcon, ChatAlt2Icon } from '@heroicons/vue/solid';

export default {
  name: 'CreatorContentBar',
  components: {
    ThumbUpIcon,
    PlayIcon,
    ChatAlt2Icon,
  },
};
</script>
