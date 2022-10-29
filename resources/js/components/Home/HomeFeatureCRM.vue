<template>
  <div class="bg-gray-50">
    <div class="mx-auto max-w-7xl py-12">
      <div
        v-for="feature in features"
        :key="feature.id"
        class="group relative grid grid-cols-2 items-center overflow-hidden py-48 odd:text-left even:text-right">
        <div
          class="mx-auto max-w-md items-center px-4 group-odd:order-first group-even:order-last sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
          <div>
            <!--   <h2
          class="bg-gradient-to-r from-sky-500 via-blue-500 to-fuchsia-500 bg-clip-text text-xs font-semibold uppercase tracking-wide text-transparent">
          Import social media profiles in
          </h2> -->
            <p
              class="mt-2 bg-gradient-to-r from-sky-500 via-blue-500 to-fuchsia-500 bg-clip-text text-xl font-extrabold tracking-tight text-gray-900 sm:text-2xl">
              {{ feature.header }}
            </p>

            <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">
              {{ feature.subheader }}
            </p>
            <div class="mt-6">
              <ButtonGroup
                v-if="feature.cta"
                :buttonlink="feature.ctaLink"
                :text="feature.cta" />
            </div>
          </div>
        </div>
        <div class="mx-auto w-full items-center rounded-md">
          <div class="h-full w-full rounded-md">
            <!--  <img class="object-fit" :src="feature.img" alt="" /> -->
            <img
              class="last:w-full lg:hidden last:lg:absolute last:lg:inset-y-0 last:lg:h-full last:lg:w-auto last:lg:max-w-none group-odd:lg:right-0"
              :src="feature.img"
              alt="" />
            <img
              class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5"
              :src="feature.img"
              alt="Inbox user interface" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
export default {
  name: 'HomeFeatureCRM',
  components: {
    ButtonGroup,
  },
  props: {
    features: {
      type: Object,
      required: true,
      default: () => {},
    },
  },
};
</script>
