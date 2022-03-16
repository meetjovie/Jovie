<template>
  <div class="mt-10 divide-y divide-gray-200">
    <div class="space-y-1">
      <h3 class="text-lg font-medium leading-6 text-gray-900">Account</h3>
      <p class="max-w-2xl text-sm text-gray-500">
        Manage how information is displayed on your account.
      </p>
    </div>
    <div class="mt-6">
      <dl class="divide-y divide-gray-200">
        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
          <dt class="text-sm font-medium text-gray-500">Language</dt>
          <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">English</span>
            <span class="ml-4 flex-shrink-0">
              <button
                type="button"
                class="rounded-md bg-white font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                Update
              </button>
            </span>
          </dd>
        </div>
        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5 sm:pt-5">
          <dt class="text-sm font-medium text-gray-500">Date format</dt>
          <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <span class="flex-grow">DD-MM-YYYY</span>
            <span class="ml-4 flex flex-shrink-0 items-start space-x-4">
              <button
                type="button"
                class="rounded-md bg-white font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                Update
              </button>
              <span class="text-gray-300" aria-hidden="true">|</span>
              <button
                type="button"
                class="rounded-md bg-white font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                Remove
              </button>
            </span>
          </dd>
        </div>
      </dl>
    </div>
  </div>
</template>
<script>
export default {
  name: AccountTeam,
};
</script>
