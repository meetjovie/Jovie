<template>
  <section>
    <div class="grid place-items-center bg-gray-700 p-4">
      <div>
        <div
          :id="'Jovie_MA_' + divId"
          :class="`h-[${assetHeight}px] w-[${assetWidth}px]`"
          class="relative overflow-hidden bg-gradient-to-b from-neutral-200 to-neutral-50">
          <slot>
            <!-- Content -->
            <div
              class="relative mt-24 flex h-full w-full flex-col items-center space-y-4 p-8 text-center">
              <h1
                class="bg-gradient-to-r from-sky-500 via-blue-600 to-fuchsia-500 bg-clip-text text-2xl font-semibold uppercase tracking-wide text-transparent">
                Meet Jovie
              </h1>

              <h2
                class="uppercse text-7xl font-extrabold tracking-normal text-neutral-800 md:text-5xl xl:text-8xl">
                The Social CRM
                <br />
              </h2>
              <h2
                class="mb-12 inline py-2 text-center text-xl font-bold text-neutral-500">
                A
                <span
                  class="dexoration-2 font-bold underline decoration-pink-400"
                  >smarter</span
                >
                way to organize everyone you follow<br />
              </h2>

              <img
                class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
                :src="asset('img/External/HomeFeatureCRM.webp')" />
            </div>
          </slot>
        </div>
      </div>
      <div class="flex w-full max-w-5xl items-center justify-between py-4">
        <h2 class="text-md font-semibold text-white">{{ name }}</h2>

        <ButtonGroup
          class="w-60"
          text="Download"
          @click="downloadImage('Jovie_MA_' + divId)">
          Download
        </ButtonGroup>
      </div>
    </div>
  </section>
</template>
<script>
import ButtonGroup from '../components/ButtonGroup.vue';
export default {
  components: {
    ButtonGroup,
  },
  props: {
    name: {
      type: String,
      default: 'Marquee promo tile',
    },
    divId: {
      type: String,
      default: 'MarqueePromoTile',
    },
    assetHeight: {
      type: Number,
      default: 560,
    },
    assetWidth: {
      type: Number,
      default: 1400,
    },
  },
  methods: {
    downloadImage(idFromParent) {
      this.$emit('downloadImage', idFromParent);
      console.log('downloadImage', idFromParent);
    },
  },
};
</script>
