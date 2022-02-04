 <template>
                <div
                    class="grid grid-cols-2 px-8 bg-gradient-to-r backdrop-blur-xl backdrop-saturate-150 from-indigo-500 via-purple-500 to-pink-500">
                    <div class="max-w-4xl mx-auto px-4 py-16 sm:px-6 sm:pt-20 sm:pb-24 lg:max-w-7xl lg:pt-24 lg:px-8">
                        <h2 class="text-3xl font-extrabold text-white tracking-tight">
                            Disocver creators with AI
                        </h2>
                        <p class="mt-4 max-w-3xl text-lg text-indigo-200">
                            Find <span class="text-neutral-100">highly relevant</span> and <span class="text-neutral-100">influential creators</span> in seconds...
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
                        <img :src="asset('images/sun.png')" alt="">
                        <div
                            class="bg-white/90 backdrop-blur-xl bg-saturate-150 font-bold text-lg text-center text-gray-800 py-4 px-4 rounded-lg shadow-xl mx-auto">
                            Find <span
                            class="underline decoration-4 decoration-pink-600 text-neutral-900 px-1">female</span> <span
                            class="underline decoration-4 decoration-amber-600 ">micro-influencers</span> wearing <span
                            class="underline decoration-4 decoration-sky-600 text-neutral-900 px-1">sunglasses</span>
                        </div>
                    </div>
                </div>
            
</template>
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

export default {
    name: "HomeFeatureDiscovery",
    components: {
        ChatAltIcon,
        DocumentReportIcon,
        HeartIcon,
        InboxIcon,
        PencilAltIcon,
        ReplyIcon,
        TrashIcon,
        UsersIcon,
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
        }
    },
}
  
</script>
