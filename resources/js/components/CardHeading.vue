<template>
  <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">{{title}}</h3>
    <p class="mt-1 text-sm text-gray-500">{{subtitle}}</p>
  </div>
</template>
<script>


export default {
    name: 'CardHeading',
    props: {
        title: {
            type: String,
            default: '',
        },
        subtitle: {
            type: String,
            default: '',
        },
    },
}
</script>

