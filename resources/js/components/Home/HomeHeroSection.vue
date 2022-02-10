<template>
    <div class="relative bg-gradient-to-r from-white to-indigo-50 overflow-hidden">
                <div class="hidden sm:block sm:absolute sm:inset-y-0 sm:h-full sm:w-full" aria-hidden="true">
                    <div class="relative h-full max-w-7xl mx-auto">
                        <svg class="absolute right-full transform translate-y-1/4 translate-x-1/4 lg:translate-x-1/2"
                             width="404" height="784" fill="none" viewBox="0 0 404 784">
                            <defs class="text-indigo-700">
                                <pattern id="f210dbf6-a58d-4871-961e-36d5016a0f49" x="0" y="0" width="20" height="20"
                                         patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200 opacity-50"
                                          fill="currentColor"/>
                                </pattern>
                            </defs>
                            <rect width="404" height="784" fill="url(#f210dbf6-a58d-4871-961e-36d5016a0f49)"/>
                        </svg>
                        <svg
                            class="absolute left-full transform -translate-y-3/4 -translate-x-1/4 md:-translate-y-1/2 lg:-translate-x-1/2"
                            width="404" height="784" fill="none" viewBox="0 0 404 784">
                            <defs>
                                <pattern id="5d0dd344-b041-4d26-bec4-8d33ea57ec9b" x="0" y="0" width="20" height="20"
                                         patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                                </pattern>
                            </defs>
                            <rect width="404" height="784" class fill="url(#5d0dd344-b041-4d26-bec4-8d33ea57ec9b)"/>
                        </svg>
                    </div>
                </div>

                <div class="relative pt-12 pb-16 sm:pb-24">


                    <main class="mt-16 mx-auto max-w-7xl py-8 lg:py-24 px-4 min-h-1/2 sm:mt-24">
                        <div class="text-center">
                            <h1 class="text-3xl md:text-5xl xl:text-6xl tracking-tight font-extrabold text-gray-900">
                                <span class="inline">Scale your</span>
                                {{ ' ' }}
                                <span class="inline text-indigo-700">creator</span>
                                
                                {{ ' ' }}
                                <span class="inline"> partnerships</span>
                            </h1>
                            <p class="mt-3 max-w-md mx-auto text-center text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                                <span class="font-bold">Easily </span>
                                {{ ' ' }}
                                <span class="font-bold text-indigo-600">build</span>, <span class="font-bold text-indigo-600">manage</span>, & <span class="font-bold text-indigo-600">grow </span>
                                <span class="underline font-bold decoration-pink-500 decoration-4 ">creator communities</span>.
                            </p>
                            <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                                <div class="rounded-md ">
                                    <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                                        <form class="sm:flex">
                                            <label v-if="!$store.state.addedToWaitList" for="email-address"
                                                   class="sr-only">Email address</label>
                                            <input v-if="!$store.state.addedToWaitList" id="email-address"
                                                   v-model="waitListEmail" name="email-address" type="email"
                                                   autocomplete="email" required=""
                                                   class="w-full shadow-xl shadow-indigo-700/20 border-indigo-700/30 px-5 py-3 placeholder-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white rounded-md"
                                                   placeholder="Enter your email"/>
                                            <button v-if="$store.state.addedToWaitList" type="button"
                                                    class="mt-3  hover:shadow-sm w-full flex items-center justify-center px-5 py-3 border border-transparent shadow-xl shadow-indigo-700/30 text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                                                Added to waitlist
                                            </button>
                                            <button v-else type="button" @click="requestDemo()"
                                                    class="mt-3  hover:shadow-sm w-full flex items-center justify-center px-5 py-3 border border-transparent shadow-xl shadow-indigo-700/30 text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-700 focus-visible:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                                                Request Demo
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
</template>