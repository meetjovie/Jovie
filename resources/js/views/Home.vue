<template>
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
                        <form method="post" class="mt-4 sm:max-w-lg sm:w-full sm:flex">
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
                        <img class="w-full rounded-md ring-1 ring-black ring-opacity-5 lg:h-full lg:w-auto lg:max-w-none" src="" alt="">
                    </div>
                    <div class="bg-neutral-700 font-bold text-lg text-center text-gray-100 w-2/3 py-4 px-4 rounded-lg shadow-xl mx-auto">
                        Find <span class="underline decoration-4 decoration-pink-600 text-white px-1">female</span> <span class="underline decoration-4 decoration-amber-600 ">micro-influencers</span> wearing <span class="underline decoration-4 decoration-sky-600 text-white px-1">sunglasses</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</template>

<script>
export default {
    name: "Home"
}
</script>

<style scoped>

</style>
