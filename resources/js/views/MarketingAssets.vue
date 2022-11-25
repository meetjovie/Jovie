<template>
  <div>
    <div class="flex w-full items-center justify-between px-4 py-4">
      <h1 class="text-xl font-bold text-slate-900">Jovie Brand Assets</h1>
      <ButtonGroup class="w-60" text="Download All" @click="downloadAll()">
      </ButtonGroup>
    </div>
    <div class="w-full bg-slate-200 py-2">
      <div class="flex max-w-7xl space-x-8 px-12">
        <div
          v-for="category in categories"
          :key="category.id"
          class="cursor-pointer text-sm"
          @click="toggleCategory(category.name)">
          <span :class="[{ 'font-bold': category.active }]">
            {{ category.name }}
          </span>
        </div>
      </div>
    </div>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :assetHeight="560"
      :assetWidth="1400"
      :divId="'MarqueePromoTile'"
      :name="'Marquee Promo Tile'">
      <!-- Content -->
      <div
        class="relative mt-24 flex h-full w-full flex-col items-center space-y-4 p-8 text-center">
        <h1
          class="text-2xl font-semibold uppercase tracking-wide text-sky-500 text-transparent">
          Meet Jovie
        </h1>

        <h2
          class="uppercse text-7xl font-extrabold tracking-normal text-slate-800 md:text-5xl xl:text-8xl">
          The Social CRM
          <br />
        </h2>
        <h2
          class="mb-12 inline py-2 text-center text-xl font-bold text-slate-500">
          A
          <span class="dexoration-2 font-bold underline decoration-pink-400"
            >smarter</span
          >
          way to organize everyone you follow<br />
        </h2>

        <img
          class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
          :src="asset('img/External/HomeFeatureCRM.webp')" />
      </div>
    </MarketingAsset>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :assetHeight="680"
      :assetWidth="920"
      :divId="'LargePromoTile'"
      :name="'Large Promo Tile'">
      <!-- Content -->
      <div
        class="relative mt-48 flex h-full w-full flex-col items-center space-y-4 p-8 text-center">
        <h1
          class="text-2xl font-semibold uppercase tracking-wide text-sky-500 text-transparent">
          Meet Jovie
        </h1>

        <h2
          class="uppercse text-7xl font-extrabold tracking-normal text-slate-800 md:text-5xl xl:text-8xl">
          The Social CRM
          <br />
        </h2>
        <h2
          class="mb-12 inline py-2 text-center text-xl font-bold text-slate-500">
          A
          <span class="dexoration-2 font-bold underline decoration-pink-400"
            >smarter</span
          >
          way to organize everyone you follow<br />
        </h2>

        <img
          class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
          :src="asset('img/External/HomeFeatureCRM.webp')" />
      </div>
    </MarketingAsset>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :assetHeight="280"
      :assetWidth="440"
      :divId="'SmallPromoTile'"
      :name="'Small Promo Tile'">
      <!-- Content -->
      <div
        class="relative mt-24 flex h-full w-full flex-col items-center space-y-4 p-8 text-center">
        <h1
          class="text-2xl font-semibold uppercase tracking-wide text-sky-500 text-transparent">
          Meet Jovie
        </h1>

        <h2
          class="uppercse text-7xl font-extrabold tracking-normal text-slate-800 md:text-5xl xl:text-8xl">
          The Social CRM
          <br />
        </h2>
        <h2
          class="mb-12 inline py-2 text-center text-xl font-bold text-slate-500">
          A
          <span class="dexoration-2 font-bold underline decoration-pink-400"
            >smarter</span
          >
          way to organize everyone you follow<br />
        </h2>

        <img
          class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
          :src="asset('img/External/HomeFeatureCRM.webp')" />
      </div>
    </MarketingAsset>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :divId="'ChromeSS1'"
      :assetHeight="800"
      :assetWidth="1280"
      :name="'Chrome Screenshot'">
      <!-- Content -->
      <div
        class="relative mt-24 flex h-full w-full flex-col items-center space-y-4 p-8 text-center">
        <h1
          class="text-4xl font-semibold uppercase tracking-wide text-sky-500 text-transparent">
          Meet Jovie
        </h1>

        <h2
          class="uppercse text-7xl font-extrabold tracking-normal text-slate-800 md:text-5xl xl:text-8xl">
          The Social CRM
          <br />
        </h2>
        <h2 class="inline py-2 text-center text-3xl font-bold text-slate-500">
          A
          <span class="dexoration-2 font-bold underline decoration-pink-400"
            >smarter</span
          >
          way to organize everyone you follow<br />
        </h2>
        <img
          class="mt-48 rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
          :src="asset('img/External/HomeFeatureCRM.webp')" />
      </div>
    </MarketingAsset>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :divId="'ChromeSS2'"
      :assetHeight="800"
      :assetWidth="1280"
      :name="'Chrome Screenshot'">
      <!-- Content -->
      <div class="relative grid h-full w-full grid-cols-2 p-8">
        <div class="mt-80 items-center text-center">
          <h1
            class="mt-6 items-center text-3xl font-semibold uppercase tracking-wide text-sky-500">
            Save Anyone In A Click
          </h1>
        </div>
        <div>
          <img
            class="rounded-xl shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
            :src="
              asset(
                'img/External/Marketing/Chrome/Jovie_Chrome_Extension_Screenshot.png'
              )
            " />
        </div>
      </div>
    </MarketingAsset>
    <MarketingAsset
      :category="'Chrome'"
      @downloadImage="downloadImage($event)"
      :divId="'ChromeSS3'"
      :assetHeight="800"
      :assetWidth="1280"
      :name="'Chrome Screenshot'">
      <!-- Content -->
      <div class="reverse relative grid h-full w-full grid-cols-2 p-8">
        <div class="order-last mt-80 items-center text-center">
          <h1
            class="mt-6 items-center text-3xl font-semibold uppercase tracking-wide text-pink-500">
            Organize your social connections
          </h1>
        </div>
        <div>
          <img
            class="mx-auto mt-24 w-2/3 items-center rounded-xl shadow-xl shadow-pink-700/30 ring-1 ring-black ring-opacity-5"
            :src="
              asset('img/External/Marketing/Chrome/Jovie_Lists_Screenshot.png')
            " />
        </div>
      </div>
    </MarketingAsset>
    <MarketingAsset
      @downloadImage="downloadImage($event)"
      :category="'Chrome'"
      :divId="'ChromeSS4'"
      :assetHeight="800"
      :assetWidth="1280"
      :name="'Chrome Screenshot'">
      <!-- Content -->
      <h1
        class="mt-6 items-center text-center text-3xl font-semibold uppercase tracking-wide text-violet-500">
        Enrich profiles with contact info & social data
      </h1>
      <div class="reverse relative grid h-full w-full grid-cols-2 p-8">
        <div>
          <img
            class="rounded-xl shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
            :src="
              asset(
                'img/External/Marketing/Chrome/Jovie_Chrome_Extension_Screenshot.png'
              )
            " />
        </div>
        <div>
          <img
            class="rounded-xl shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
            :src="
              asset(
                'img/External/Marketing/Chrome/Jovie_Chrome_Extension_Screenshot.png'
              )
            " />
        </div>
      </div>
    </MarketingAsset>
  </div>
</template>
<script>
import JovieLogo from './../components/JovieLogo.vue';
import ButtonGroup from './../components/ButtonGroup.vue';
import * as html2canvas from 'html2canvas';
import MarketingAsset from './../components/MarketingAsset.vue';

export default {
  components: {
    JovieLogo,
    ButtonGroup,
    MarketingAsset,
  },
  data() {
    return {
      divHeight: 0,
      categories: [
        {
          id: 0,
          name: 'All',
          active: true,
        },
        {
          id: 1,
          name: 'Chrome',
          active: true,
        },
        {
          id: 2,
          name: 'Branding',
          active: false,
        },
      ],
    };
  },
  methods: {
    toggleCategory(category) {
      this.categories.forEach((cat) => {
        if (cat.name == category.name) {
          cat.active = true;
        } else if (category.name == 'All') {
          cat.active = true;
        } else {
          cat.active = false;
        }
      });
    },
    // Download image
    downloadImage(id) {
      console.log(id);
      // Get the image from the id
      const image = document.getElementById(id);
      console.log(image);
      // Convert the image to a canvas
      html2canvas(image).then((canvas) => {
        // Convert the canvas to a blob
        console.log(canvas);
        canvas.toBlob((blob) => {
          // Create a link to download the image
          const link = document.createElement('a');
          link.href = URL.createObjectURL(blob);
          link.download = `${id}.png`;
          link.click();
        });
      });
    },
    // Download all images
    downloadAll() {
      // Get all the images
      const images = document.querySelectorAll('div[id^="Jovie_MA_"]');
      // Loop through the images
      images.forEach((image) => {
        // Convert the image to a canvas
        html2canvas(image).then((canvas) => {
          // Convert the canvas to a blob
          canvas.toBlob((blob) => {
            // Create a link to download the image
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `${image.id}.png`;
            link.click();
          });
        });
      });
    },
  },
};
</script>
