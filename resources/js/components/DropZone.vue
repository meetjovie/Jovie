<template>
  <div
    @dragcenter.prevent="toggelActive"
    @dragleave.prevent="toggleActive"
    @dragover.prevent
    @drop.prevent="toggleActive"
    :class="{ 'bg-indigo-100': active }"
    class="group mt-1 flex justify-center rounded-md border-2 border-dashed border-slate-300 px-6 py-12 hover:border-slate-400">
    <div class="space-y-1 text-center">
      <CloudArrowUpIcon
        class="mx-auto h-12 w-12 text-slate-200 group-hover:text-slate-400" />
      <div class="flex text-sm text-slate-600">
        <label
          for="file-upload"
          class="focus-active:underline-indigo-500 focus-active:ring-offset-2 focus-active:outline-none focus-active:ring-2 relative cursor-pointer rounded-md bg-slate-100 font-medium text-indigo-600 hover:text-indigo-500">
          <span>Upload a file</span>
          <input
            id="file-upload"
            name="file-upload"
            ref="file_upload"
            type="file"
            @change="getColumnsFromCsv()"
            class="sr-only" />
        </label>
        <p class="pl-1">or drag and drop</p>
      </div>
      <p class="text-xs text-slate-500">CSV</p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'DropZone',
};
</script>
