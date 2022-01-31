<template>
    <div class="bg-neutral-800">
        <header>
            <nav>
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-12">
                        <div class="flex">

                            <div class="flex-shrink-0 flex text-white items-center">
                                <a href="/">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="69px" height="20px">
                                        <path fill-rule="evenodd"  fill="rgb(255, 255, 255)"
                                              d="M57.964,14.130 C58.057,14.960 58.283,15.578 58.639,15.984 C59.141,16.568 59.795,16.861 60.602,16.861 C61.111,16.861 61.596,16.734 62.054,16.480 C62.335,16.319 62.636,16.035 62.959,15.629 L68.068,16.099 C67.287,17.453 66.344,18.425 65.240,19.013 C64.135,19.602 62.551,19.896 60.487,19.896 C58.695,19.896 57.284,19.644 56.257,19.140 C55.229,18.637 54.377,17.836 53.702,16.740 C53.027,15.644 52.689,14.355 52.689,12.873 C52.689,10.765 53.366,9.059 54.721,7.755 C56.076,6.451 57.947,5.799 60.334,5.799 C62.271,5.799 63.800,6.091 64.921,6.675 C66.042,7.260 66.896,8.106 67.482,9.215 C68.068,10.325 68.362,11.768 68.362,13.546 L68.362,14.130 L57.964,14.130 ZM62.277,9.507 C61.840,9.076 61.264,8.860 60.551,8.860 C59.727,8.860 59.068,9.186 58.576,9.838 C58.261,10.244 58.062,10.849 57.977,11.654 L63.086,11.654 C62.984,10.655 62.715,9.939 62.277,9.507 ZM46.406,6.104 L51.592,6.104 L51.592,19.591 L46.406,19.591 L46.406,6.104 ZM46.406,0.973 L51.592,0.973 L51.592,4.491 L46.406,4.491 L46.406,0.973 ZM35.939,19.591 L30.311,6.104 L35.707,6.104 L38.332,14.651 L41.056,6.104 L46.289,6.104 L40.538,19.591 L35.939,19.591 ZM29.730,17.908 C28.349,19.233 26.440,19.896 24.002,19.896 C21.827,19.896 20.069,19.346 18.727,18.245 C17.079,16.882 16.255,15.095 16.255,12.886 C16.255,10.828 16.951,9.133 18.345,7.799 C19.738,6.466 21.619,5.799 23.989,5.799 C26.699,5.799 28.746,6.582 30.131,8.149 C31.244,9.410 31.800,10.964 31.800,12.809 C31.800,14.884 31.110,16.583 29.730,17.908 ZM25.863,10.212 C25.378,9.641 24.779,9.355 24.066,9.355 C23.310,9.355 22.685,9.645 22.193,10.225 C21.700,10.805 21.454,11.688 21.454,12.873 C21.454,14.075 21.698,14.964 22.186,15.540 C22.675,16.116 23.289,16.403 24.028,16.403 C24.775,16.403 25.389,16.120 25.869,15.553 C26.349,14.985 26.589,14.075 26.589,12.822 C26.589,11.654 26.347,10.784 25.863,10.212 ZM12.781,18.754 C11.639,19.524 10.176,19.908 8.392,19.908 C6.506,19.908 5.045,19.655 4.009,19.147 C2.972,18.639 2.171,17.896 1.607,16.918 C1.042,15.940 0.708,14.731 0.606,13.292 L6.124,12.543 C6.132,13.364 6.204,13.974 6.340,14.371 C6.476,14.769 6.705,15.091 7.028,15.337 C7.249,15.498 7.564,15.578 7.971,15.578 C8.617,15.578 9.090,15.339 9.392,14.861 C9.693,14.383 9.844,13.577 9.844,12.444 L9.844,0.973 L15.629,0.973 L15.629,11.088 C15.629,13.212 15.440,14.828 15.062,15.936 C14.684,17.045 13.924,17.984 12.781,18.754 Z"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="hidden md:ml-6 md:items-center md:space-x-4">
                                <!-- Current: "bg-neutral-900 text-white", Default: "text-neutral-300 hover:bg-neutral-700 hover:text-white" -->
                                <a href="/product" class="bg-neutral-900 text-white px-3 py-2 rounded-md text-xs font-medium"
                                   aria-current="page">Product</a>

                                <!--<a href="/pricing"
                                    class="text-neutral-300 hover:bg-neutral-700 hover:text-white px-3 py-2 rounded-md text-xs font-medium">Pricing</a>-->


                            </div>
                        </div>
                        <div class="hidden sm:flex items-center">
                            <div class="flex-shrink-0 ">
                                <div v-if="!$store.state.AuthState.loading">
                                    <div v-if="!$store.state.AuthState.isAuthenticated" class="cursor-pointer">
                                        <div class="inline-flex">
                                            <a @click="login()"
                                            class="text-neutral-300 cursor-hover:text-neutral-200 hover:text-white px-4 py-2 rounded-md text-xs font-medium">Sign in
                                            </a>
                                        </div>
                                        <div class="inline-flex">
                                            <a class:="justify-center px-2 max-auto" @click="demo">
                                                <router-link to='demo'
                                                        class="relative inline-flex group items-center px-2 py-1 border text-xs font-medium rounded-md text-neutral-200 hover:text-white bg-neutral-800 border-1 border-neutral-300 hover:border-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-neutral-800 focus-visible:ring-neutral-500">
                                                    <span>Request Demo</span>
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="block group-hover:hidden ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="hidden group-hover:block ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                        </svg>
                                                    </span>
                                                </router-link>
                                            </a>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <router-link to="dashboard" class="text-sm border-transparent group rounded-md w-32 px-2 py-1 inline-flex items-center font-medium text-neutral-400 hover:text-neutral-100">
                                            Dashboard
                                        </router-link>
                                    </div>
                                </div>
                                <div v-else>
                                    Loading ...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="md:hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <div v-if="!$store.state.AuthState.loading">
                            <div v-if="!$store.state.AuthState.isAuthenticated">
                                <a @click="login()"
                                   class="text-neutral-300 hover:text-neutral-200 hover:text-white px-3 py-2 rounded-md text-xs font-medium">Login</a>
                            </div>
                            <div v-else>
                                <a href="/" class="bg-neutral-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                                   aria-current="page">Dashboard</a>
                            </div>
                        </div>
                        <div v-else>
                            Loading ...
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <!-- This example requires Tailwind CSS v2.0+ -->

  <div class="relative bg-gradient-to-r from-white to-indigo-50 overflow-hidden">
    <div class="hidden sm:block sm:absolute sm:inset-y-0 sm:h-full sm:w-full" aria-hidden="true">
      <div class="relative h-full max-w-7xl mx-auto">
        <svg class="absolute right-full transform translate-y-1/4 translate-x-1/4 lg:translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
          <defs class="text-indigo-700">
            <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
              <rect x="0" y="0" width="4" height="4" class="text-gray-200 opacity-50" fill="currentColor" />
            </pattern>
          </defs>
          <rect width="404" height="784" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)" />
        </svg>
        <svg class="absolute left-full transform -translate-y-3/4 -translate-x-1/4 md:-translate-y-1/2 lg:-translate-x-1/2" width="404" height="784" fill="none" viewBox="0 0 404 784">
          <defs>
            <pattern id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
              <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
            </pattern>
          </defs>
          <rect width="404" height="784" class fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)" />
        </svg>
      </div>
    </div>

    <div class="relative pt-12 pb-16 sm:pb-24">


      <main class="mt-16 mx-auto max-w-7xl py-8 lg:py-24 px-4 min-h-1/2 sm:mt-24">
        <div class="text-center">
          <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block xl:inline">Grow your community</span>
            {{ ' ' }}
            <span class="block text-indigo-700 xl:inline">with creators</span>
          </h1>
          <p class="mt-3 max-w-md mx-auto text-center text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            <span class="font-bold text-indigo-600">Jovie</span> identifies the creators most likely to <span class="underline font-bold decoration-pink-500 decoration-4 ">love</span> your brand.
          </p>
          <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
            <div class="rounded-md ">
              <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
              <form class="sm:flex">
                <label v-if="!$store.state.addedToWaitList" for="email-address" class="sr-only">Email address</label>
                <input v-if="!$store.state.addedToWaitList" id="email-address" v-model="waitListEmail" name="email-address" type="email" autocomplete="email" required="" class="w-full shadow-xl shadow-indigo-700/20 border-indigo-700/30 px-5 py-3 placeholder-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white rounded-md" placeholder="Enter your email" />
                <button type="button" @click="requestDemo()" class="mt-3  hover:shadow-sm w-full flex items-center justify-center px-5 py-3 border border-transparent shadow-xl shadow-indigo-700/30 text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                  {{ $store.state.addedToWaitList ? 'Added to waitlist' : 'Request Demo' }}
                </button>
              </form>
              <span class="text-red-900 float-left">{{ this.error }}</span>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

<!--

           <div class="pb-8 sm:pb-12 lg:pb-12">
                <div class="pt-2 sm:pt-12 lg:relative lg:py-48">
                    <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-7xl lg:grid lg:grid-cols-2 lg:gap-24">
                        <div>

                            <div class="mt-4 sm:mt-20">
                                <div>
                                    <div class="inline-flex space-x-4">
                            <span class="rounded bg-sky-400 px-2.5 py-1 text-xs font-semibold text-gray-900 tracking-wide uppercase">
                            Creator discovery
                            </span>
                                        <span class="inline-flex items-center text-sm font-medium text-gray-300 space-x-1">
                                    <span>with Jovie AI</span>

                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 sm:max-w-xl">
                                    <h1 class="text-5xl bg-clip-text font-extrabold text-white tracking-tight sm:text-7xl uppercase text-transparent bg-gradient-to-l from-fuchsia-500 via-violet-500 to-sky-500">
                                        Find creators
                                    </h1>
                                    <h1 class="text-xl font-extrabold text-white tracking-wide sm:text-3xl">
                                        by the <span class="text-indigo-400 italic">products </span>&<span class="text-indigo-400 italic"> brands</span> they love
                                    </h1>
                                    <p class="mt-4 text-md sm:text-xl text-gray-400">
                                        <span class="font-bold text-gray-200">Jovie</span> searches <span class="font-bold text-gray-200">within images & videos</span> to find creators already invested in a product category.
                                    </p>
                                </div>
                                <div class="mt-4 text-gray-100 sm:max-w-lg sm:w-full sm:flex">
                                    <p>Thanks! We'll be in touch.</p>
                                </div>
                                <form action="" method="post" class="mt-4 sm:max-w-lg sm:w-full sm:flex">
                                    <div class="min-w-0 flex-1">
                                        <label for="hero-email" class="sr-only">Email address</label>
                                        <input id="hero-email" name="email" type="email" class="block w-full border border-gray-300 rounded-md px-5 py-3 text-base text-gray-900 placeholder-gray-500 shadow-sm focus-active:border-gray-500 focus-active:ring-gray-500" placeholder="Enter your email">
                                    </div>
                                    <div class="mt-4 sm:mt-0 sm:ml-3">
                                        <button type="submit" class="block justify-between text-left items-center group w-60 rounded-md border line-clamp-1 border-transparent pr-5 pl-8 py-3 bg-indigo-500 text-base font-medium text-white shadow hover:bg-indigo-600 focus-active:outline-none focus-active:ring-2 focus-active:ring-gray-500 focus-active:ring-offset-2 sm:px-10">
                                            <span class="">Request access</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex group-hover:hidden h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="hidden group-hover:inline-flex ml-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <div class="border-t opacity-30 mt-4">

                                </div>
                                <div class="text-neutral-400 py-4 font-bold text-xs">
                                    Trusted by the creator economy innovators:

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:mx-auto sm:max-w-3xl sm:px-6 items-center">
                        <div class="py-4 2xl:py-6 sm:relative sm:mt-12 sm:py-16 lg:absolute items-center lg:inset-y-0 mt-10 lg:right-0 lg:w-1/2">

                            <div class="relative pl-4 -mr-40 sm:mx-auto sm:max-w-3xl sm:px-0 lg:max-w-none lg:h-2/3 lg:pl-12">
                                <img class="w-full rounded-md ring-1 ring-black ring-opacity-5 lg:h-full lg:w-auto lg:max-w-none" src="/images/sun.png" alt="">
                            </div>
                            <div class="bg-neutral-700 font-bold text-lg text-center text-gray-100 w-2/3 py-4 px-4 rounded-lg shadow-xl mx-auto">
                                Find <span class="underline decoration-4 decoration-pink-600 text-white px-1">female</span> <span class="underline decoration-4 decoration-amber-600 ">micro-influencers</span> wearing <span class="underline decoration-4 decoration-sky-600 text-white px-1">sunglasses</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  -->
            <!-- <LogoCloud>
                 <div class="bg-white">
                    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-12 sm:px-6 lg:px-8">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8">

                        <h2 class="max-w-md mx-auto text-3xl font-extrabold text-neutral-700 text-center lg:max-w-xl lg:text-left">
                        Creator economy startups <span class="text-indigo-700">trust Jovie</span>
                        </h2>
                        <div class="flow-root self-center mt-8 lg:mt-0">
                        <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
                           <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                            <img class="h-10 opacity-30 saturate-0" src="/images/Logos/Zelf.svg" alt="Zelf" />
                            </div>
                            <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                            <img class="h-10 opacity-30 saturate-0" src="\images\Logos\Fuego.svg" alt="Fuego" />
                            </div>
                            <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                            <img class="h-12 opacity-30 saturate-0" src="https://uploads-ssl.webflow.com/60cb5f56c3b31702dd6b1934/60cb64fa20a93418b234363f_Flowbo-Colors-p-500.png" alt="Flowbo" />
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </LogoCloud> -->

            <FeatureSection>
            <div class="grid grid-cols-2 px-8 bg-gradient-to-r backdrop-blur-xl backdrop-saturate-150 from-indigo-500 via-purple-500 to-pink-500">
                <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 sm:pt-20 sm:pb-24 lg:max-w-7xl lg:pt-24 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">
                    AI Powered Disocvery
                </h2>
                <p class="mt-4 max-w-3xl text-lg text-indigo-200">
                    Discover highly relevant and influential creators in seconds...
                </p>
                <div class="mt-12 grid grid-cols-2 gap-x-6 gap-y-12 lg:mt-16 lg:gap-x-8 lg:gap-y-8">
                    <div v-for="feature in features" :key="feature.name" class="col-span-1">

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-white">{{ feature.name }}</h3>
                            <p class="mt-2 text-xs text-indigo-100">
                            {{ feature.description }}
                            </p>
                        </div>
                    </div>

                </div>
                </div>
                <div class="py-8 items-center">
                    <img src="/images/sun.png" alt="">
                    <div class="bg-white/90 backdrop-blur-xl bg-saturate-150 font-bold text-lg text-center text-gray-800 py-4 px-4 rounded-lg shadow-xl mx-auto">
                        Find <span class="underline decoration-4 decoration-pink-600 text-neutral-900 px-1">female</span> <span class="underline decoration-4 decoration-amber-600 ">micro-influencers</span> wearing <span class="underline decoration-4 decoration-sky-600 text-neutral-900 px-1">sunglasses</span>
                    </div>
                </div>
            </div>
            </FeatureSection>
            <Tesitimonial>
                <section class="py-12 bg-gray-50 overflow-hidden md:py-20 lg:py-24">
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <svg class="absolute top-full right-full transform translate-x-1/3 -translate-y-1/4 lg:translate-x-1/2 xl:-translate-y-1/2" width="404" height="404" fill="none" viewBox="0 0 404 404" role="img" aria-labelledby="svg-workcation">
                        <title id="svg-workcation">Zelf</title>
                        <defs>
                        <pattern id="ad119f34-7694-4c31-947f-5c9d249b21f3" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                        </defs>
                        <rect width="404" height="404" fill="url(#ad119f34-7694-4c31-947f-5c9d249b21f3)" />
                    </svg>

                    <div class="relative">
                        <img class="mx-auto h-8" src="images/Logos/Zelf.svg" alt="Zelf" />
                        <blockquote class="mt-10">
                        <div class="max-w-3xl mx-auto text-center text-2xl leading-9 font-medium text-gray-900">
                            <p>
                            &ldquo;Jovie kicks ass and is awesome.&rdquo;
                            </p>
                        </div>
                        <footer class="mt-8">
                            <div class="md:flex md:items-center md:justify-center">
                            <div class="md:flex-shrink-0">
                                <img class="mx-auto h-10 w-10 rounded-full" src="https://media-exp1.licdn.com/dms/image/C4D03AQGZyOT_1GtFlw/profile-displayphoto-shrink_200_200/0/1629220506369?e=1648684800&v=beta&t=7GfOr2rn9vHTAbImqtyE9AE03VqK4nOjxZezdHVThJQ" alt="" />
                            </div>
                            <div class="mt-3 text-center md:mt-0 md:ml-4 md:flex md:items-center">
                                <div class="text-base font-medium text-gray-900">Pepijn van Kesteren</div>

                                <svg class="hidden md:block mx-1 h-5 w-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
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
            </Tesitimonial>
            <CTA>
                <div class="bg-indigo-700">
                    <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                        <span class="block">See <span class="underline decoration-2 decoration-fuchsia-400">Jovie</span> in action.</span>

                    </h2>
                    <p class="mt-4 text-lg leading-6 text-indigo-200">Learn how Jovie <span class="font-bold text-indigo-100">saves you time</span> by automating redudant tasks.</p>
                    <router-link to="demo" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">
                        Watch demo
                    </router-link>

                    </div>
                </div>
            </CTA>


        </main>
    </div>
</template>

<style>

</style>
<script>
import {
  ChatAltIcon,
  DocumentReportIcon,
  HeartIcon,
  InboxIcon,
  PencilAltIcon,
  ReplyIcon,
  TrashIcon,
  UsersIcon,
} from '@heroicons/vue/outline'
import UserService from "../services/api/user.service";
import { useAuth0 } from "../utils/useAuth0";
const { login, logout, initAuth } = useAuth0();

export default {
    name: "Home",
    setup() {
        initAuth();
    },
    data() {
      return {
          features: [
              {
                  name: 'Discover creators by the products they use',
                  description: 'Jovie can see if a creator is wearing glass, holding an iPhone, or riding a skateboard. ',
                  icon: InboxIcon,
              },
              {
                  name: 'Identify Brands within content',
                  description: 'Search for Starbucks logos in Tiktok videos, or people wearing Prada on Instagram.',
                  icon: UsersIcon,
              },
              {
                  name: 'Brand Saftey',
                  description: 'Jovie can identify & restrict creators who post content that may not be suitable for your brand. ',
                  icon: TrashIcon,
              },
              {
                  name: 'Exclusion',
                  description: 'Jovie can check to make creators you partner with have never promoted a competing product.',
                  icon: PencilAltIcon,
              },
          ],
          waitListEmail: '',
          error: null
      }
    },
    methods: {
        login() {
            login()
        },
        logout() {
            logout()
        },
        async requestDemo() {
            await UserService.addToWaitList({email: this.waitListEmail}).then(response => {
                response = response.data
                if (response.status) {
                    this.$store.commit('setAddedToWaitList')
                    this.waitListEmail = ''
                    this.error = null
                    this.$router.push('demo')
                }
            }).catch(error => {
                error = error.response
                if (error.status == 422) {
                    this.error = error.data.errors.email[0]
                }
            })
        }
    }
}
</script>
