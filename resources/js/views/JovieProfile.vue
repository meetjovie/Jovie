<template>
  <div class="bg-gray-100">
    <div
      class="mx-auto flex min-h-screen w-full max-w-7xl flex-col justify-center px-4 sm:px-6 lg:px-8">
      <div class="relative">
        <div class="relative bg-gray-100">
          <div
            class="mx-auto max-w-7xl px-4 sm:px-6 lg:grid lg:grid-cols-2 lg:px-8">
            <div class="mx-auto max-w-2xl pb-24 lg:max-w-none lg:py-64">
              <div class="visible ml-1 lg:invisible lg:h-0">
                <img
                  :src="asset('img/External/jovie_profile_mobile.png')"
                  alt=""
                  class="object-fit mx-auto h-1/3 w-auto" />
              </div>
              <div class="lg:pr-16">
                <h1
                  class="text-center text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-left xl:text-6xl">
                  Simple. Beautiful.
                </h1>
                <h1
                  class="text-center text-4xl font-extrabold tracking-tight text-indigo-700 sm:text-5xl lg:text-left xl:text-6xl">
                  Contact profiles.
                </h1>
                <p
                  class="mt-4 text-center text-xl text-gray-600 lg:text-left lg:text-lg">
                  6 Links. <span class="font-bold">1 Call to action. </span>
                  <br class="block sm:hidden" />Zero Distractions.
                </p>
                <div class="mt-6 sm:flex sm:justify-center lg:justify-start">
                  <div class="rounded-md shadow">
                    <a
                      href="/signup"
                      class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-3 text-base font-medium text-white hover:bg-indigo-700 md:py-4 md:px-10 md:text-lg">
                      Build your profile
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="mx-auto hidden max-w-2xl lg:flex lg:max-w-none lg:py-4">
              <div
                class="items-top top-0 mx-auto mt-0 hidden w-full text-center md:flex">
                <img
                  class="hidden h-auto w-full object-contain md:block"
                  id="target"
                  :src="asset('img/External/jovie_profile.png')" />
                <!-- <div
                  class="mx-auto mt-8 w-2/3 rounded-lg border-4 border-gray-300 bg-gray-50 px-8 py-4 text-left text-lg font-bold text-gray-900">
                  https://jov.ie/<span
                    class="font-light text-gray-700 opacity-50"
                    >yournamehere</span
                  > 
                </div>-->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="relative">
            <div class="relative bg-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:grid lg:grid-cols-2">
                    <div class="hidden md:flex max-w-2xl mx-auto lg:py-4 lg:max-w-none">
                        <div class="hidden md:flex w-full mt-0 top-0 items-top text-center mx-auto">
                            <img class="hidden md:block h-auto w-full  object-contain" id="target" src="a.jpg">
                        </div>
                    </div>
                    <div class="max-w-2xl mx-auto pb-24 lg:py-64 lg:max-w-none">
                        <div class="visible ml-1 lg:h-0 lg:invisible">
                            <img src="{{ asset('/images/a7x3me_profile_mobile.png') }}" alt=""
                                 class="w-auto mx-auto h-1/3 object-fit">
                        </div>
                        <div class="lg:pr-16 contents-right text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 mb-2 rounded-md text-sm font-medium bg-indigo-100 text-purple-800">
                                  What brands see
                                </span>
                            <h1 class="text-4xl text-center sm:text-right font-extrabold tracking-tight text-gray-900 sm:text-5xl xl:text-6xl">
                                Creator</h1>
                            <h1 class="text-4xl text-center sm:text-right font-extrabold tracking-tight text-indigo-700 sm:text-5xl xl:text-6xl">
                                Media kits</h1>
                            <p class="mt-4 text-xl text-center sm:text-right lg:text-lg text-gray-600">Get more<span
                                        class="font-bold"> paid partnerships</span>
                                <br>with a media kit that updates itself.</p>
                            <div class="mt-6">
                                <a href="/signup"
                                   class="min-w-full lg:min-w-0 text-center inline-block bg-indigo-600 border border-transparent py-3 px-8 rounded-md font-medium text-white hover:bg-indigo-700">Get
                                    started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
  </div>
</template>
