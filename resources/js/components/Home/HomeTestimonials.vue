<template>
  <section class="overflow-hidden bg-gray-50 py-12 md:py-20 lg:py-24">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <svg
        class="absolute top-full right-full translate-x-1/3 -translate-y-1/4 transform lg:translate-x-1/2 xl:-translate-y-1/2"
        width="404"
        height="404"
        fill="none"
        viewBox="0 0 404 404"
        role="img"
        aria-labelledby="svg-workcation">
        <title id="svg-workcation">Zelf</title>
        <defs>
          <pattern
            id="ad119f34-7694-4c31-947f-5c9d249b21f3"
            x="0"
            y="0"
            width="20"
            height="20"
            patternUnits="userSpaceOnUse">
            <rect
              x="0"
              y="0"
              width="4"
              height="4"
              class="text-gray-200"
              fill="currentColor" />
          </pattern>
        </defs>
        <rect
          width="404"
          height="404"
          fill="url(#ad119f34-7694-4c31-947f-5c9d249b21f3)" />
      </svg>

      <div class="relative">
        <img
          class="mx-auto h-8"
          :src="asset('img/External/Logos/Zelf.svg')"
          alt="Zelf" />
        <blockquote class="mt-10">
          <div
            class="mx-auto max-w-3xl text-center text-sm font-medium leading-9 text-gray-900 md:text-lg">
            <p>
              &ldquo;Jovie allowed us to do in 2 weeks what we had been trying
              to do <br class="block sm:hidden" />for 3 months…
              <br class="hideen sm:block" />Never had we seen such fast adoption
              by creators. Five stars.&rdquo;
            </p>
          </div>
          <footer class="mt-8">
            <div class="md:flex md:items-center md:justify-center">
              <div class="md:flex-shrink-0">
                <img
                  class="mx-auto h-10 w-10 rounded-full"
                  :src="asset('img/External/Pepijn_vann_Kesteren.webp')"
                  alt="" />
              </div>
              <div
                class="mt-3 text-center md:mt-0 md:ml-4 md:flex md:items-center">
                <div class="text-base font-medium text-gray-900">
                  Pepijn van Kesteren
                </div>

                <svg
                  class="mx-1 hidden h-5 w-5 text-indigo-600 md:block"
                  fill="currentColor"
                  viewBox="0 0 20 20">
                  <path d="M11 0h3L9 20H6l5-20z" />
                </svg>

                <div class="text-base font-medium text-gray-500">CEO, Zelf</div>
              </div>
            </div>
          </footer>
        </blockquote>
      </div>
    </div>
  </section>
</template>
