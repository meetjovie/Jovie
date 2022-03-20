<template>
  <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
    <div>
      <h3 class="text-lg font-medium leading-6 text-gray-900">
        Account security
      </h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        Manage your Jovie security preferences.
      </p>
    </div>
  </div>
  <div class="space-y-6 sm:space-y-5">
    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="old-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        Old password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="text"
          name="old-password"
          id="old-password"
          autocomplete="given-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>

    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="new-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        New password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="text"
          name="new-password"
          id="new-password"
          autocomplete="family-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>
    <div
      class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <label
        for="new-password"
        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
        Confirm new password
      </label>
      <div class="mt-1 sm:col-span-2 sm:mt-0">
        <input
          type="text"
          name="new-password"
          id="new-password"
          autocomplete="family-name"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm" />
      </div>
    </div>
    <div
      class="justify-right sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
      <ButtonGroup text="Update password" />
    </div>
  </div>
</template>
<script>
import ButtonGroup from '../../components/ButtonGroup.vue';

export default {
  components: {
    ButtonGroup,
  },
};
</script>
