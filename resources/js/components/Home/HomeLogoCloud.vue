<template>
  <div class="">
    <div class="mx-auto max-w-xl py-4 px-4 sm:px-6 sm:py-8 lg:px-8">
      <div class="justify center mx-auto items-center">
        <h2
          class="mx-auto max-w-md py-4 text-center text-xs font-extrabold text-neutral-400 lg:max-w-xl lg:text-center">
          Join top creator economy companies powered by Jovie
        </h2>
        <div class="mt-12 flow-root self-center lg:mt-0">
          <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
            <div
              class="mt-4 flex flex-shrink-0 flex-grow justify-center lg:flex-grow-0">
              <img
                class="h-8 opacity-30 saturate-0"
                :src="asset('img/External/Logos/Zelf.svg')"
                alt="Zelf" />
            </div>
            <div
              class="mt-4 flex flex-shrink-0 flex-grow justify-center lg:flex-grow-0">
              <img
                class="h-8 opacity-30 saturate-0"
                :src="asset('img/External/Logos/Fuego.svg')"
                alt="Fuego" />
            </div>
            <div
              class="mt-4 flex flex-shrink-0 flex-grow justify-center lg:flex-grow-0">
              <img
                class="h-8 opacity-30 saturate-0"
                :src="asset('img/External/Logos/superjoi.webp')"
                alt="Fuego" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'HomeLogoCloud',
};
</script>
