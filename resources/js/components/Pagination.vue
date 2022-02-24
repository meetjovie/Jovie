<template>
  <nav
    class="fixed bottom-0 mx-2 flex w-full items-center border-t border-gray-200 bg-white px-4 pb-2 sm:px-0">
    <div class="-mt-px flex w-0 flex-1 justify-end">
      <a
        :disabled="isInFirstPage"
        @click="onClickPreviousPage"
        href="#"
        class="inline-flex items-center border-t-2 border-transparent pt-2 pr-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        <ArrowNarrowLeftIcon
          class="mr-3 h-5 w-5 text-gray-400"
          aria-hidden="true" />
        Previous
      </a>
    </div>
    <div class="hidden md:-mt-px md:flex">
      <template v-for="page in pages">
        <a
          href="#"
          @click="onClickPage(page.name)"
          :disabled="page.isDisabled"
          :class="{ 'text-indigo border-indigo-500': currentPage == page.name }"
          class="pt- inline-flex items-center border-t-2 border-transparent px-4 pt-2 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
          {{ page.name }}
        </a>
      </template>

      <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
      <!--            <a href="#" class="border-indigo-500 text-indigo-600 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium" aria-current="page"> 2 </a>-->
      <!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 3 </a>-->

      <!--            <span class="border-transparent text-gray-500 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> ... </span>-->

      <!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 8 </a>-->
      <!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 9 </a>-->
      <!--            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"> 10 </a>-->
    </div>
    <div class="-mt-px flex w-0 flex-1 justify-start">
      <a
        :disabled="isInLastPage"
        @click="onClickNextPage()"
        href="#"
        class="inline-flex items-center border-t-2 border-transparent pt-2 pl-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
        Next
        <ArrowNarrowRightIcon
          class="ml-3 h-5 w-5 text-gray-400"
          aria-hidden="true" />
      </a>
    </div>
  </nav>
</template>
<script>
import {
  ArrowNarrowLeftIcon,
  ArrowNarrowRightIcon,
} from '@heroicons/vue/solid';
export default {
  name: 'Pagination',
  props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 3,
    },
    totalPages: {
      type: Number,
      required: true,
    },
    perPage: {
      type: Number,
      required: true,
    },
    currentPage: {
      type: Number,
      required: true,
    },
  },
  components: {
    ArrowNarrowLeftIcon,
    ArrowNarrowRightIcon,
  },
  data() {
    return {};
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
        i <=
        Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
        i++
      ) {
        range.push({
          name: i,
          isDisabled: i === this.currentPage,
        });
      }

      return range;
    },
  },
  methods: {
    onClickFirstPage() {
      this.$emit('pagechanged', { page: 1 });
    },
    onClickPreviousPage() {
      this.$emit('pagechanged', { page: this.currentPage - 1 });
    },
    onClickPage(page) {
      this.$emit('pagechanged', { page: page });
    },
    onClickNextPage() {
      this.$emit('pagechanged', { page: this.currentPage + 1 });
    },
    onClickLastPage() {
      this.$emit('pagechanged', { page: this.totalPages });
    },
  },
};
</script>
