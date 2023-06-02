<template>
  <body class="overflow-y-hidden">
    <div
      class="flex w-full flex-col-reverse items-center justify-center py-12 md:flex-col">
      <img
        src="https://i.ibb.co/KFN84NL/bgImg.png"
        class="mt-6 hidden w-full object-fill object-center md:mt-0 xl:block"
        alt="background image" />
      <img
        src="https://i.ibb.co/Lxn1MTX/tabley.png"
        class="mt-6 w-full object-fill object-center md:mt-0 xl:hidden"
        alt="background image" />
      <div class="absolute flex flex-col items-center justify-center px-4">
        <h1
          class="text-3xl font-extrabold tracking-tight text-slate-900 md:text-5xl xl:text-6xl">
          <span class="inline">Scale your</span>
          {{ ' ' }}
          <span class="inline text-indigo-700">creator</span>

          {{ ' ' }}
          <span class="inline"> partnerships</span>
        </h1>
        <p
          class="mx-auto mt-3 max-w-md text-center text-base text-slate-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
          <span class="font-bold">Easily </span>
          {{ ' ' }}
          <span class="font-bold text-indigo-600">build</span>,
          <span class="font-bold text-indigo-600">manage</span>, &
          <span class="font-bold text-indigo-600">grow </span>
          <span class="font-bold underline decoration-pink-500 decoration-4"
            >creator communities</span
          >.
        </p>
        <div class="mx-auto mt-5 max-w-md sm:flex sm:justify-center md:mt-8">
          <div class="rounded-md">
            <div class="mt-8 sm:w-full sm:max-w-md xl:ml-8 xl:mt-0">
              <div class="sm:flex">
                <label for="email-address" class="sr-only">Email address</label>
                <input
                  v-on:keyup.enter="requestDemo()"
                  id="email-address"
                  v-model="waitListEmail"
                  name="email-address"
                  type="email"
                  autocomplete="off"
                  required=""
                  class="focus-visible:ring-none focus-visible:ring-none w-full rounded-md border-indigo-700/30 px-5 py-3 placeholder-slate-500 shadow-xl shadow-indigo-700/20 focus-visible:border-none focus-visible:outline-none focus-visible:outline-none"
                  placeholder="Enter your email" />

                <button
                  type="button"
                  as="router-link"
                  @click="requestDemo()"
                  class="mt-3 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-500 px-5 py-3 text-base font-medium text-white shadow-xl shadow-indigo-700/30 hover:bg-indigo-800 hover:shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 sm:ml-3 sm:mt-0 sm:w-auto sm:flex-shrink-0">
                  Get started
                </button>
              </div>
              <span class="float-left text-red-900">{{ this.error }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</template>
