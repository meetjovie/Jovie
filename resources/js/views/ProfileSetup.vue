<template>
  <div class="mx-auto items-center py-24">
    <div class="mx-12">
      <h4 class="sr-only">Status</h4>
      <p class="text-sm font-medium text-gray-900">
        Creating your Jovie profile...
      </p>
      <div class="mt-6" aria-hidden="true">
        <div class="overflow-hidden rounded-full bg-gray-200">
          <div
            class="h-2 rounded-full bg-indigo-600"
            :style="{ width: status.percentage + '%' }" />
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

    <div>Nav here</div>
    Your profile

    <div v-if="!user.profile_pic_url">Add a photo</div>
    //v-if the user doesnt not have a profile picture

    <div v-if="step2">What are your social handles?</div>
    <div v-if="step3">Pick a username</div>
    <div v-if="step4">Here's your profile</div>
  </div>
</template>
<script>
export default {
  name: 'ProfileSetup',
  components: {},
  data() {
    return {
      step1: true,
      status: [
        {
          percentage: 20,
        },
      ],
    };
  },
};
</script>
