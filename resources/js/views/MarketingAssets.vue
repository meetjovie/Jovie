<template>
  <div>
    <div class="flex w-full items-center justify-between px-4 py-4">
      <h1 class="text-xl font-bold text-neutral-900">Jovie Brand Assets</h1>
      <ButtonGroup class="w-60" text="Download All" @click="downloadAll()">
        Download All
      </ButtonGroup>
    </div>
    <section>
      <div class="grid place-items-center bg-gray-700 p-4">
        <div
          id="ChromeBanner"
          class="relative h-[560px] w-[1400px] overflow-hidden bg-gradient-to-b from-neutral-200 to-neutral-50">
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
              class="inline py-2 text-center text-xl font-bold text-neutral-500">
              A
              <span class="dexoration-2 font-bold underline decoration-pink-400"
                >smarter</span
              >
              way to organize everyone you follow<br />
            </h2>
          </div>
          <div class="hidden max-w-7xl sm:block">
            <img
              class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
              :src="asset('img/External/HomeFeatureCRM.webp')" />
          </div>
        </div>
        <div class="flex w-full max-w-5xl items-center justify-between py-4">
          <h2 class="text-md font-semibold text-white">
            Chrome Web Store Banner
          </h2>

          <ButtonGroup
            class="w-60"
            text="Download"
            @click="downloadImage('ChromeBanner')">
            Download
          </ButtonGroup>
        </div>
      </div>
    </section>
    <section>
      <div class="grid place-items-center bg-gray-700 p-4">
        <div
          id="ChromeSS1"
          class="relative h-[400px] w-[640px] overflow-hidden bg-gradient-to-b from-neutral-200 to-neutral-50">
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
              class="inline py-2 text-center text-xl font-bold text-neutral-500">
              A
              <span class="dexoration-2 font-bold underline decoration-pink-400"
                >smarter</span
              >
              way to organize everyone you follow<br />
            </h2>
          </div>
          <div class="hidden max-w-7xl sm:block">
            <img
              class="rounded-lg shadow-xl shadow-indigo-700/30 ring-1 ring-black ring-opacity-5"
              :src="asset('img/External/HomeFeatureCRM.webp')" />
          </div>
        </div>

        <div class="flex w-full max-w-5xl items-center justify-between py-4">
          <h2 class="text-md font-semibold text-white">Chrome Screenshot</h2>

          <ButtonGroup
            class="w-60"
            text="Download"
            @click="downloadImage('ChromeSS1')">
            Download
          </ButtonGroup>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import JovieLogo from './../components/JovieLogo.vue';
import ButtonGroup from './../components/ButtonGroup.vue';
import * as html2canvas from 'html2canvas';

export default {
  components: {
    JovieLogo,
    ButtonGroup,
  },
  methods: {
    // Download image
    downloadImage(id) {
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
      const images = document.querySelectorAll('div[id^="Chrome"]');
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
