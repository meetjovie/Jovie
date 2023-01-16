<template>
  <JovieDropdownMenu
    @itemClicked="addCustomField(item)"
    :items="customFields"
    placement="left-start"
    ><template #triggerButton
      ><PlusIcon
        class="h-4 w-4 text-slate-600 dark:text-jovieDark-200"></PlusIcon></template
  ></JovieDropdownMenu>
  <Teleport to="body">
    <Dialog :open="isOpen" @close="setIsOpen">
      <DialogPanel>
        <GlassmorphismContainer>
          <DialogTitle>Deactivate account</DialogTitle>
          <DialogDescription>
            This will permanently deactivate your account
          </DialogDescription>

          <p>
            Are you sure you want to deactivate your account? All of your data
            will be permanently removed. This action cannot be undone.
          </p>

          <button @click="setIsOpen(false)">Deactivate</button>
          <button @click="setIsOpen(false)">Cancel</button>
        </GlassmorphismContainer>
      </DialogPanel>
    </Dialog>
  </Teleport>
</template>

<script>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  DialogDescription,
} from '@headlessui/vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';

import JovieDropdownMenu from './JovieDropdownMenu.vue';
import { PlusIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    PlusIcon,
    JovieDropdownMenu,
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
    GlassmorphismContainer,
  },
  data() {
    return {
      isOpen: true,
      customFields: [
        {
          name: 'Text',
        },
        {
          name: 'Number',
        },
        {
          name: 'Currency',
        },
        {
          name: 'Date',
        },
        {
          name: 'URL',
        },

        {
          name: 'Checkbox',
        },
        {
          name: 'Single Select',
        },
        {
          name: 'Multi Select',
        },
      ],
    };
  },

  methods: {
    closeDialog() {
      this.isOpen = false;
    },
    setIsOpen(value) {
      this.isOpen = value;
    },
    addCustomField(field) {
      console.log(field.id);
    },
  },
};
</script>
