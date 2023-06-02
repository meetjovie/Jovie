<template>
  <div
    class="col-span-1 divide-y divide-gray-200 rounded border border-slate-200 bg-white shadow hover:bg-slate-50 dark:border-jovieDark-border dark:bg-jovieDark-800">
    <div class="flex w-full items-center justify-between space-x-6 p-6">
      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3
            class="truncate text-sm font-medium text-slate-900 dark:text-jovieDark-100">
            {{ contact.full_name || 'First Last' }}
          </h3>
          <span
            class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"
            >{{ contact.emails[0] }}</span
          >
        </div>
        <p class="mt-1 truncate text-sm text-slate-500 dark:text-jovieDark-300">
          {{ contact.job_title || 'Job Title' }}
        </p>
      </div>
      <img
        class="h-10 w-10 flex-shrink-0 rounded-full bg-slate-300"
        :src="contact.profile_pic_url"
        alt="" />
    </div>
    <div>
      <div class="-mt-px flex divide-x divide-slate-200">
        <div class="flex w-0 flex-1">
          <a
            :href="`mailto:${contact.emails[0]}`"
            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-slate-900 dark:text-jovieDark-100">
            <EnvelopeIcon
              class="h-5 w-5 text-slate-400 dark:text-jovieDark-200"
              aria-hidden="true" />
            Email
          </a>
        </div>
        <div class="-ml-px flex w-0 flex-1">
          <a
            :href="`tel:${contact.telephone}`"
            class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-slate-900 dark:text-jovieDark-100">
            <PhoneIcon
              class="h-5 w-5 text-slate-400 dark:text-jovieDark-200"
              aria-hidden="true" />
            Call
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    contact: {
      type: Object,
      required: true,
    },
  },
};
</script>
