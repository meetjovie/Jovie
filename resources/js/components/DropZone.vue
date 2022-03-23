<template>
    <!-- add `data-active` and the event listeners -->
    <div :data-active="active" @dragenter.prevent="setActive" @dragover.prevent="setActive" @dragleave.prevent="setInactive" @drop.prevent="onDrop">
        <!-- share state with the scoped slot -->
        <slot :dropZoneActive="active"></slot>
    </div>
</template>

<script setup>
// make sure to import `ref` from Vue
import { ref, onMounted, onUnmounted } from 'vue'
const emit = defineEmits(['files-dropped'])

let active = ref(false)
let inActiveTimeout = null // add a variable to hold the timeout key

function setActive() {
    active.value = true
    clearTimeout(inActiveTimeout) // clear the timeout
}
function setInactive() {
    // wrap it in a `setTimeout`
    inActiveTimeout = setTimeout(() => {
        active.value = false
    }, 50)
}

function onDrop(e) {
    setInactive() // add this line too
    emit('files-dropped', [...e.dataTransfer.files])
}

function preventDefaults(e) {
    e.preventDefault()
}

const events = ['dragenter', 'dragover', 'dragleave', 'drop']

onMounted(() => {
    events.forEach((eventName) => {
        document.body.addEventListener(eventName, preventDefaults)
    })
})

onUnmounted(() => {
    events.forEach((eventName) => {
        document.body.removeEventListener(eventName, preventDefaults)
    })
})
</script>
