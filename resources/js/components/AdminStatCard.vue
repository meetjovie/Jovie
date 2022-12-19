<template>
  <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-jovieDark-800">
    <div class="p-5">
      <div class="flex items-center">
        <div class="h-32 w-0 flex-1">
          <dl>
            <dd>
              <div
                v-if="stat === null"
                class="mx-auto items-center text-center text-7xl font-bold text-indigo-700 dark:text-jovieDark-300">
                <div class="itesm-center mx-auto h-24">
                  <JovieSpinner class="mx-auto items-center" />
                </div>
              </div>
              <div
                v-else

                class="text-center text-7xl font-bold text-indigo-700 dark:text-jovieDark-300">
                <span v-if="currency">${{ formatCount(stat) }}</span>



                <span v-else>{{ formatCount(stat) }}</span>
              </div>
            </dd>
            <dt
              v-if="subtitle"
              class="truncate text-center text-sm font-medium text-slate-500 dark:text-jovieDark-300">
              {{ subtitle }}
            </dt>
          </dl>
        </div>
      </div>
    </div>
    <div class="bg-slate-50 px-5 py-3 dark:bg-jovieDark-700">
      <div class="text-sm">
        <a
          href="#"
          class="text-center font-medium text-indigo-700 hover:text-cyan-900 dark:text-jovieDark-300">
          {{ title }}
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import JovieSpinner from '../components/JovieSpinner';
export default {
  components: {
    JovieSpinner,
  },

  props: {
    stat: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
    currency: {
      type: Boolean,
      default: null,
    },
  },
};
</script>
