<template>
  <div class="mx-auto h-screen max-w-5xl flex-col justify-between py-12">
    <div class="mx-12">
      <h4 class="sr-only">Status</h4>
      <p class="text-sm font-medium text-gray-900">
        Creating your Jovie profile...
      </p>
      <div class="mt-6" aria-hidden="true">
        <div class="overflow-hidden rounded-full bg-gray-200">
          <div
            class="h-2 rounded-full bg-indigo-600"
            :style="{ width: status.percentage }" />
        </div>
        <div
          class="mt-6 hidden grid-cols-4 text-sm font-medium text-gray-600 sm:grid">
          <div class="text-indigo-600">Upload a photo</div>
          <div class="text-center text-indigo-600">Add social Links</div>
          <div class="text-center">Set a username</div>
          <div class="text-right">Done</div>
        </div>
      </div>
    </div>

    <div class="rounded-md bg-neutral-400 py-6 px-4 text-center">
      <div v-if="!step1Complete">Add a photo</div>

      <div v-else-if="!step2Complete">What are your social handles?</div>
      <div v-else-if="!step3Complete">Pick a username</div>
      <div v-else>Here's your profile</div>
    </div>

    <div class="text-2x font-bold">This will only take a moment</div>
  </div>
</template>
<script>
export default {
  name: 'ProfileSetup',
  components: {},
  data() {
    return {
      step1Complete: false,
      step2Complete: false,
      step3Complete: false,
      status: [
        {
          percentage: 20,
        },
      ],
    };
  },
};
</script>
