<template>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-12 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">

            <h2 class="max-w-md mx-auto text-3xl font-extrabold text-neutral-700 text-center lg:max-w-xl lg:text-left">
            Creator economy startups <span class="text-indigo-700">trust Jovie</span>
            </h2>
            <div class="flow-root self-center mt-8 lg:mt-0">
            <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
                <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                <img class="h-10 opacity-30 saturate-0" :src="asset('img/External/Logos/Zelf.svg')" alt="Zelf" />
                </div>
                <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                <img class="h-10 opacity-30 saturate-0" :src="asset('img/External/Logos/Fuego.svg')" alt="Fuego" />
                </div>
                <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                <img class="h-12 opacity-0 saturate-0" :src="asset('/img/External/Logos/flowbo_logo.webp')" alt="Flowbo" />
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
}
</script>
