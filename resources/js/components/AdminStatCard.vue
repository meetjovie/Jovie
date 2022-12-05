<template>
  <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-slate-800">
    <div class="p-5">
      <div class="flex items-center">
        <div class="w-0 flex-1">
          <dl>
            <dd>
              <div
                class="text-center text-7xl font-bold text-indigo-700 dark:text-slate-300">
                {{ stat }}
              </div>
            </dd>
            <dt
              v-if="subtitle"
              class="truncate text-center text-sm font-medium text-slate-500 dark:text-slate-300">
              {{ subtitle }}
            </dt>
          </dl>
        </div>
      </div>
    </div>
    <div class="bg-slate-50 px-5 py-3 dark:bg-slate-700">
      <div class="text-sm">
        <a
          href="#"
          class="text-center font-medium text-indigo-700 hover:text-cyan-900 dark:text-slate-300">
          {{ title }}
        </a>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    stat: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
};
</script>
