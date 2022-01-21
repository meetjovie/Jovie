<script setup>
import { useAuth0, AuthState } from "../utils/useAuth0";
const { login, logout, initAuth } = useAuth0(AuthState);

initAuth();
</script>

<template>
    <div>
        <header>
            <nav class="bg-neutral-800">
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
                            <div class="flex-shrink-0">
                                <div v-if="!AuthState.loading">
                                    <div v-if="!AuthState.isAuthenticated">
                                        <a @click="login()"
                                           class="text-neutral-300 hover:text-neutral-200 hover:text-white px-3 py-2 rounded-md text-xs font-medium">Login
                                        </a>
                                        <a href="mailto:info@a7x3.com?subject=Request: Creator Search Platform Demo&body=Hey! I would love a demo of your awesome creator discovery platform! :)">
                                            <button type="button"
                                                    class="relative inline-flex items-center px-2 py-1 border border-transparent shadow-sm text-xs font-medium rounded-md text-white bg-neutral-500 hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-neutral-800 focus:ring-neutral-500">
                                                <span>Request Demo</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div v-else>
                                        <a class="text-sm border-transparent group rounded-md w-32 px-2 py-1 inline-flex items-center font-medium text-neutral-400 hover:text-neutral-100">Dashboard</a>
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
                        <div v-if="!AuthState.loading">
                            <div v-if="!AuthState.isAuthenticated">
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
            <div class="pb-8 sm:pb-12 lg:pb-12">
                <div class="pt-2 sm:pt-12 lg:relative lg:py-48">
                    <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-7xl lg:grid lg:grid-cols-2 lg:gap-24">
                        <div>

                            <div class="mt-4 sm:mt-20">
                                <div>
                                    <div class="inline-flex space-x-4">
                            <span class="rounded bg-neutral-50 px-2.5 py-1 text-xs font-semibold text-gray-600 tracking-wide uppercase">
                            Creator discovery
                            </span>
                                        <span class="inline-flex items-center text-sm font-medium text-gray-300 space-x-1">
                                    <span>with Jovie AI</span>
                                            <!-- Heroicon name: solid/chevron-right -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 sm:max-w-xl">
                                    <h1 class="text-5xl font-extrabold text-white tracking-tight sm:text-7xl">
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
                                        <button type="submit" class="block justify-between text-left items-center group w-60 rounded-md border line-clamp-1 border-transparent pr-5 py-3 bg-indigo-500 text-base font-medium text-white shadow hover:bg-indigo-600 focus-active:outline-none focus-active:ring-2 focus-active:ring-gray-500 focus-active:ring-offset-2 sm:px-10">
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
                                <div class="border-t opacity-30 mt-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:mx-auto sm:max-w-3xl sm:px-6">
                        <div class="py-12 sm:relative sm:mt-12 sm:py-16 lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">

                            <div class="relative pl-4 -mr-40 sm:mx-auto sm:max-w-3xl sm:px-0 lg:max-w-none lg:h-full lg:pl-12">
                                <img class="w-full rounded-md ring-1 ring-black ring-opacity-5 lg:h-full lg:w-auto lg:max-w-none" src="/images/sun.png" alt="">
                            </div>
                            <div class="bg-neutral-700 font-bold text-lg text-center text-gray-100 w-2/3 py-4 px-4 rounded-lg shadow-xl mx-auto">
                                Find <span class="underline decoration-4 decoration-pink-600 text-white px-1">female</span> <span class="underline decoration-4 decoration-amber-600 ">micro-influencers</span> wearing <span class="underline decoration-4 decoration-sky-600 text-white px-1">sunglasses</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Footer-->
        <footer class="fixed items-bottom bottom-0 my-auto">
            <div class="inset-x-0 my-auto bottom-0 mx-auto px-4 sm:px-6 lg:px-8 ">
                <div class="text-xs py-2 text-xs text-gray-500  bottom-0 items-baseline sm:text-left">
                    <span class="block sm:inline">&copy; 2021 | <a href="/privacy">Privacy</a> | <a href="/privacy">Terms</a></span></div>
            </div>
        </footer>
    </div>
</template>

<style>

</style>
