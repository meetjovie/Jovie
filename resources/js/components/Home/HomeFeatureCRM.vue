<template>
  <div class="mx-auto max-w-7xl">
    <div class="mx-auto max-w-7xl space-y-6 py-12">
      <h3 class="py-12 text-center text-3xl font-bold text-neutral-900">
        Jovie creates contacts
        <span class="text-purple-700">in 1-click</span>
      </h3>
      <FeatureCard v-for="feature in features" :key="feature.id">
        <div v-if="feature.id == 1" class="absolute top-0 right-12">
          <svg
            width="87"
            height="37"
            viewBox="0 0 87 37"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M24.9137 -43.0372C28.2274 -48.7767 35.5665 -50.7432 41.306 -47.4295L80.0057 -25.0863C85.7452 -21.7726 87.7117 -14.4335 84.3979 -8.69397L62.0547 30.0057C58.741 35.7452 51.4019 37.7117 45.6624 34.3979L6.96279 12.0547C1.22328 8.74101 -0.743213 1.40192 2.5705 -4.33759L24.9137 -43.0372Z"
              fill="#FFD058" />
          </svg>
        </div>
        <div v-if="feature.id == 1" class="absolute left-96 bottom-0 mx-auto">
          <svg
            width="106"
            height="48"
            viewBox="0 0 106 48"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M53 0L61.5235 18.4189L77.6303 6.07083L76.6178 26.341L96.6181 22.8926L86.3015 40.3704L105.614 46.6116L88.3563 57.293L102.556 71.7941L82.3114 73.2322L88.1455 92.6711L69.5516 84.5364L65.6837 104.46L53 88.616L40.3163 104.46L36.4484 84.5364L17.8545 92.6711L23.6886 73.2322L3.44414 71.7941L17.6437 57.293L0.386429 46.6116L19.6985 40.3704L9.38185 22.8926L29.3822 26.341L28.3697 6.07083L44.4765 18.4189L53 0Z"
              fill="#CCCCFB" />
          </svg>
        </div>
        <div v-if="feature.id == 2" class="absolute right-0">
          <svg
            width="489"
            height="400"
            viewBox="0 0 489 400"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g opacity="0.8">
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 707.499 273.132)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 689.375 287.293)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 671.251 301.454)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 653.128 315.615)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 613.729 346.4)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 574.33 377.185)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 534.93 407.97)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 495.531 438.755)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
              <circle
                r="362"
                transform="matrix(-0.787983 0.615698 0.615698 0.787983 456.132 469.54)"
                stroke="#D1CCD9"
                stroke-width="2"
                stroke-linecap="round"
                stroke-dasharray="0.1 12" />
            </g>
          </svg>
        </div>
        <div
          class="items-center sm:w-1/3 sm:group-odd:order-last sm:group-even:order-first">
          <div class="mt-4 justify-start px-12">
            <h3
              class="mt-2 bg-gradient-to-r from-sky-500 via-blue-500 to-fuchsia-500 bg-clip-text text-3xl font-medium leading-10 tracking-normal text-gray-900">
              {{ feature.header }}
            </h3>

            <p class="leading-wide mx-auto mt-5 text-sm text-gray-600">
              {{ feature.subheader }}
            </p>
            <div class="group/button2 mt-4" v-if="feature.id === 3">
              <ButtonGroup
                class="rounded-lg bg-gradient-to-r from-indigo-500 to-purple-500 px-4 py-4"
                v-if="feature.cta"
                :buttonlink="feature.ctaLink"
                :text="feature.cta"
                ><svg
                  class="mt-0 ml-2 -mr-1 stroke-white stroke-2"
                  fill="none"
                  width="10"
                  height="10"
                  viewBox="0 0 10 10"
                  aria-hidden="true">
                  <path
                    class="opacity-0 transition group-hover:opacity-100"
                    d="M0 5h7"></path>
                  <path
                    class="transition group-hover:translate-x-[3px]"
                    d="M1 1l4 4-4 4"></path>
                </svg>
              </ButtonGroup>
            </div>
            <div
              v-if="feature.id === 1"
              class="mt-8 border-t border-neutral-200">
              <div class="mt-6 inline-flex h-4 w-80 items-center space-x-4">
                <p class="text-sm leading-none text-gray-400">Supports</p>
                <div class="flex items-start justify-start space-x-3">
                  <div v-for="icon in socialIcons" :key="icon.id">
                    <component
                      :is="SocialIcons"
                      :icon="icon.name"
                      height="18px"
                      color="black"
                      width="18px" />
                  </div>
                  <p class="text-xs font-semibold leading-none text-gray-900">
                    +7 others
                  </p>
                </div>
              </div>
            </div>
            <div
              v-if="feature.cta && feature.id === 1"
              class="group/button mt-6">
              <ButtonGroup
                class="w-80 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-500 px-9 py-4"
                :buttonlink="feature.ctaLink"
                :text="feature.cta">
                <svg
                  role="img"
                  class="ml-2 h-5 w-5 transform transition-transform duration-300 ease-in-out group-hover/button:rotate-180"
                  fill="white"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg">
                  <title>Google Chrome</title>
                  <path
                    d="M12 0C8.21 0 4.831 1.757 2.632 4.501l3.953 6.848A5.454 5.454 0 0 1 12 6.545h10.691A12 12 0 0 0 12 0zM1.931 5.47A11.943 11.943 0 0 0 0 12c0 6.012 4.42 10.991 10.189 11.864l3.953-6.847a5.45 5.45 0 0 1-6.865-2.29zm13.342 2.166a5.446 5.446 0 0 1 1.45 7.09l.002.001h-.002l-5.344 9.257c.206.01.413.016.621.016 6.627 0 12-5.373 12-12 0-1.54-.29-3.011-.818-4.364zM12 16.364a4.364 4.364 0 1 1 0-8.728 4.364 4.364 0 0 1 0 8.728Z" />
                </svg>
              </ButtonGroup>
            </div>
          </div>
        </div>
        <div class="mx-auto flex h-full flex-col justify-end">
          <img
            v-if="feature.id === 1"
            class="h-[358px] w-[399px]"
            :src="
              asset('img/External/Marketing/Jovie_Chrome_Extension_Mockup.webp')
            "
            alt="Jovie Chrome Extension" />
          <img
            v-if="feature.id === 2"
            class="h-[328px] w-[573px]"
            :src="
              asset(
                'img/External/Marketing/Jovie_CRM_Create_Lists_Of_Social_Profiles.webp'
              )
            "
            alt="Make lists of social media profiles inside Jovie" />
          <img
            v-if="feature.id === 3"
            class="w-full object-cover lg:absolute lg:inset-y-0 lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
            :src="
              asset('img/External/Marketing/Jovie_CRM_Contact_Enrichment.webp')
            "
            alt="" />
        </div>
      </FeatureCard>
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';
import SocialIcons from '../../components/SocialIcons.vue';
import FeatureCard from '../../components/FeatureCard.vue';
export default {
  name: 'HomeFeatureCRM',
  components: {
    ButtonGroup,
    FeatureCard,
    SocialIcons,
  },
  data() {
    return {
      socialIcons: [
        {
          id: 1,
          name: 'tiktok',
        },
        {
          id: 2,
          name: 'facebook',
        },
        {
          id: 3,
          name: 'linkedin',
        },
        {
          id: 4,
          name: 'twitter',
        },
        {
          id: 5,
          name: 'youtube',
        },
        {
          id: 6,
          name: 'instagram',
        },
      ],
    };
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
