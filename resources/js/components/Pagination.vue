<template>
    <nav class="border-t border-gray-200 px-4 flex items-center sm:px-0">
        <div class="-mt-px w-0 flex-1 flex justify-end">
            <a :disabled="isInFirstPage" @click="onClickPreviousPage" href="#" class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <ArrowNarrowLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
                Previous
            </a>
        </div>
        <div class="hidden md:-mt-px md:flex">

            <template v-for="page in pages">
                <a
                    href="#"
                    @click="onClickPage(page.name)"
                    :disabled="page.isDisabled"
                    :class="{ 'border-indigo-500 text-indigo' : (currentPage == page.name) }"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium">
                    {{ page.name }}
                </a>
            </template>

        </div>
        <div class="-mt-px w-0 flex-1 flex justify-start">
            <a :disabled="isInLastPage" @click="onClickNextPage()" href="#" class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
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
    props: {
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },
        totalPages: {
            type: Number,
            required: true
        },
        perPage: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        }
    },
    components: {
        ArrowNarrowLeftIcon,
        ArrowNarrowRightIcon,
    },
    data() {
        return {
        }
    },
    mounted() {
        console.log(this.pages);
    },
    computed: {
        isInFirstPage() {
            return this.currentPage === 1;
        },
        isInLastPage() {
            return this.currentPage === this.totalPages;
        },
        startPage() {
            // When on the first page
            if (this.currentPage === 1) {
                return 1;
            }

            // When on the last page
            if (this.currentPage === this.totalPages) {
                return this.totalPages - this.maxVisibleButtons;
            }

            // When inbetween
            return this.currentPage - 1;
        },
        pages() {
            const range = [];

            for (
                let i = this.startPage;
                i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                i++
            ) {
                range.push({
                    name: i,
                    isDisabled: i === this.currentPage
                });
            }

            return range;
        },
    },
    methods: {
        onClickFirstPage() {
            this.$emit('pagechanged', {page: 1});
        },
        onClickPreviousPage() {
            this.$emit('pagechanged', {page: this.currentPage - 1});
        },
        onClickPage(page) {
            this.$emit('pagechanged', {page: page});
        },
        onClickNextPage() {
            this.$emit('pagechanged', {page: this.currentPage + 1});
        },
        onClickLastPage() {
            this.$emit('pagechanged', {page: this.totalPages});
        }
    }
}
</script>
