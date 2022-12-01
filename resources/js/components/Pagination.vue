<template>
  <div class="w-full">
    <nav
      class="transiion-all flex w-full flex-auto items-center justify-between border-t border-slate-200 bg-white px-4 pb-2 dark:bg-slate-900 sm:px-2">
      <div class="group flex">
        <a
          v-if="isFirstPage"
          :disabled="isFirstPage"
          @click="onClickPreviousPage"
          href="#"
          class="inline-flex items-center border-t-2 border-transparent pt-2 pr-1 text-xs font-medium text-slate-400 disabled:cursor-none disabled:text-slate-200 group-hover:border-slate-300 group-hover:text-slate-700 disabled:group-hover:text-slate-300 dark:disabled:text-slate-800 group-hover:dark:disabled:text-slate-800">
          <ArrowLongLeftIcon
            class="mr-3 h-3 w-3 text-slate-400 group-hover:border-slate-300 group-hover:text-slate-700"
            aria-hidden="true" />
          Previous
        </a>
      </div>
      <div class="group hidden md:flex">
        <template v-for="page in pages">
          <a
            href="#"
            @click="onClickPage(page.name)"
            :disabled="page.isDisabled"
            :class="{
              'border-indigo-500 text-indigo-700 dark:text-indigo-300':
                currentPage == page.name,
            }"
            class="inline-flex items-center border-t-2 border-transparent px-4 pt-2 text-xs font-medium text-slate-400 group-hover:border-slate-300 group-hover:text-slate-700">
            {{ page.name }}
          </a>
        </template>
        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-slate-400  dark:text-slate-400 hover:text-slate-700 hover:border-slate-300" -->
        <!--            <a href="#" class="border-indigo-500 text-indigo-600 border-t-2 pt-4 px-4 inline-flex items-center text-xs font-medium" aria-current="page"> 2 </a>-->
        <!--            <a href="#" class="border-transparent text-slate-400  dark:text-slate-400 hover:text-slate-700 hover:border-slate-300 border-t-2 pt-4 px-4 inline-flex items-center text-xs font-medium"> 3 </a>-->
      </div>
      <div class="group flex">
        <a
          :disabled="isInLastPage"
          @click="onClickNextPage()"
          href="#"
          class="mr-6 inline-flex items-center border-t-2 border-transparent pt-2 pl-1 text-xs font-medium text-slate-400 hover:border-slate-300 hover:text-slate-700 disabled:cursor-none dark:text-slate-400">
          Next
          <ArrowLongRightIcon
            class="ml-3 h-5 w-5 text-slate-400 group-hover:border-slate-300 group-hover:text-slate-700 dark:text-slate-400"
            aria-hidden="true" />
        </a>
      </div>
    </nav>
  </div>
</template>
<script>
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid';

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
    ArrowLongLeftIcon,
    ArrowLongRightIcon,
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
        return Math.abs(this.totalPages - this.maxVisibleButtons);
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
      if (this.isInFirstPage) return;
      this.$emit('pagechanged', { page: this.currentPage - 1 });
    },
    onClickPage(page) {
      this.$emit('pagechanged', { page: page });
    },
    onClickNextPage() {
      if (this.isInLastPage) return;
      this.$emit('pagechanged', { page: this.currentPage + 1 });
    },
    onClickLastPage() {
      this.$emit('pagechanged', { page: this.totalPages });
    },
  },
};
</script>
