<template>
  <!-- <img
    class="aspect-square w-48 rounded-full border-4 border-slate-400 object-cover object-center"
    :src="imageUrl"
    :alt="name" /> -->

  <div
    class="mx-auto aspect-square flex-shrink-0 justify-center object-cover object-center"
    :class="[
      { 'h-40 w-40': size == 'md' },
      { 'h-24 w-24': size == 'sm' },
      { 'h-12 w-12': size == 'xsm' },
      { 'h-6 w-6': size == 'xxsm' },
    ]">
    <div
      class="rounded-full p-1"
      :class="[
        { 'bg-slate-200': !network },
        {
          'bg-social-youtube/60': network == 'youtube',
        },
        {
          'bg-social-twitter/90': network == 'twitter',
        },
        {
          'bg-gradient-to-tr from-yellow-500/90 via-fuchsia-500/90 to-purple-500/90':
            network == 'instagram',
        },
        {
          'bg-social-snapchat': network == 'snapchat',
        },
        {
          'bg-gradient-to-l from-pink-700 to-sky-700': network == 'tiktok',
        },
      ]">
      <div class="items-center justify-center rounded-full bg-white p-0">
        <img
            @error="switchToDefaultImage"
          class="justify-center rounded-full object-cover object-center"
          :class="[
            { 'h-40 w-40': size == 'md' },
            { 'h-24 w-24': size == 'sm' },
            { 'h-12 w-12': size == 'xsm' },
            { 'h-6 w-6': size == 'xxsm' },
          ]"
          :src="imageUrl"
          :alt="name" />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'ContactAvatar',
  props: {
    imageUrl: {
      type: String,
      default: 'image',
    },
    name: {
      type: String,
      default: 'Contact',
    },
    size: {
      type: String,
      default: 'md',
    },
    network: {
      type: String,
      default: null,
    },
    height: {
      type: Number,
      default: 48,
    },
  },
};
</script>
