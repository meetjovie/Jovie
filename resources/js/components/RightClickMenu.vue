<template>
  <button
    class="cursor-pointer rounded bg-slate-200 px-4 py-2 text-slate-700 active:scale-95"
    @click="hideMenu()">
    {{ show ? 'Hide' : 'Show' }} Menu
  </button>
  <teleport to="#crm">
    <div
      v-show="show"
      :style="{ top: y + 'px', left: x + 'px' }"
      style="z-index: 9999"
      class="h-50 w-50 p-18 absolute rounded-full bg-blue-500">
      {{ x }} x {{ y }}
    </div>
  </teleport>
</template>
<script>
import ContactContextMenu from './ContactContextMenu.vue';
import DropdownMenuItem from './DropdownMenuItem.vue';
export default {
  components: { ContactContextMenu, DropdownMenuItem },
  methods: {
    hideMenu() {
      console.log('hide menu');
      //emit event to parent
      this.$emit('hide-menu');
    },
    showMenu(e) {
      this.x = e.pageX;
      this.y = e.pageY;
      this.show = true;
    },
  },
  //add props
  props: {
    contact: {
      type: Object,
      required: true,
    },
    show: {
      type: Boolean,
      default: true,
    },
    x: {
      type: Number,
      default: 0,
    },
    y: {
      type: Number,
      default: 0,
    },
  },
};
</script>
