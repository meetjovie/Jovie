<template>
    <nav class="border-t border-gray-200 px-4 flex items-center sm:px-0">
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <a href="#" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <ArrowNarrowLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                Previous
            </a>
        </div>
        <div class="hidden md:-mt-px md:flex">

            <template v-for="n in totalPages">
                <template v-if="n+1 == modelValue">
                    <a
                        href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                        {{ n }}
                    </a>
                </template>
                <template v-else-if="n == modelValue">
                    <a href="#" class="border-indigo-500 text-indigo-600 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium" aria-current="page">
                        2
                    </a>
                </template>
                <template v-else-if="n-1 == modelValue">
                    <a
                        href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                        {{ n }}
                    </a>
                </template>
                <template v-else-if="n+2 >= totalPages">
                    <a
                        href="#"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                        {{ n }}
                    </a>
                </template>
            </template>

            <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
<!--            <a href="#" class="border-indigo-500 text-indigo-600 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium" aria-current="page"> 2 </a>-->
<!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 3 </a>-->

<!--            <span class="border-transparent text-gray-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> ... </span>-->

<!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 8 </a>-->
<!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 9 </a>-->
<!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 10 </a>-->

        </div>
        <div class="-mt-px w-0 flex-1 flex justify-start">
            <a href="#" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                Next
                <ArrowNarrowRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
            </a>
        </div>
    </nav>
</template>
<script>
import { ArrowNarrowLeftIcon, ArrowNarrowRightIcon } from '@heroicons/vue/solid'
export default {
    name: 'Pagination',
    props: ['totalItems', 'perPage', 'limit', 'disabled', 'modelValue'],
    components: {
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
    },
    data() {
        return {
            totalPages: 0
        }
    },
    mounted() {
        console.log(this.totalItems);
        console.log(this.perPage);
        this.totalPages = Math.ceil((this.totalItems/this.perPage))
        console.log(this.totalPages);
    }
}
</script>
