<template>
  <!--  <JovieDropdownMenu
    @itemClicked="addCustomField"
    :items="customFields"
    placement="left-start"
    ><template #triggerButton
      ><PlusIcon
        class="h-4 w-4 text-slate-600 dark:text-jovieDark-200"></PlusIcon
    ></template>
  </JovieDropdownMenu> -->

  <!--  <Dialog :open="isOpen" @close="setIsOpen">
    <DialogPanel>
      <GlassmorphismContainer>
        <DialogTitle>Deactivate account</DialogTitle>
        <DialogDescription>
          This will permanently deactivate your account
        </DialogDescription>

        <p>You're about to create a {{ fieldType }}</p>

        <button @click="setIsOpen(false)">Deactivate</button>
        <button @click="setIsOpen(false)">Cancel</button>
      </GlassmorphismContainer>
    </DialogPanel>
  </Dialog> -->

  <Popover class="relative">
    <Float placement="left-start">
      <PopoverButton>
        <PlusIcon
          class="h-4 w-4 text-slate-600 dark:text-jovieDark-200"></PlusIcon>
      </PopoverButton>

      <PopoverPanel class="z-10 w-60">
        <GlassmorphismContainer size="3xl">
          <input
            type="text"
            class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />

          <select
            class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0">
            <option value="text">Text</option>
            <option value="textarea">Textarea</option>
            <option value="number">Number</option>
            <option value="date">Date</option>
            <option value="time">Time</option>
            <option value="datetime">Datetime</option>
            <option value="checkbox">Checkbox</option>
            <option value="radio">Radio</option>
            <option value="select">Select</option>
            <option value="file">File</option>
            <option value="image">Image</option>
            <option value="email">Email</option>
            <option value="url">URL</option>
            <option value="tel">Telephone</option>
            <option value="color">Color</option>
          </select>
        </GlassmorphismContainer>
      </PopoverPanel>
    </Float>
  </Popover>
</template>

<script>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import { Float } from '@headlessui-float/vue';
import JovieDropdownMenu from './JovieDropdownMenu.vue';
import { PlusIcon } from '@heroicons/vue/24/solid';

export default {
  components: {
    PlusIcon,
    JovieDropdownMenu,
    GlassmorphismContainer,
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
  },
  data() {
    return {
      isOpen: true,
      fieldType: '',
      customFields: [
        {
          id: 'Text',
          name: 'Text',
        },
        {
          id: 'Number',
          name: 'Number',
        },
        {
          id: 'Currency',
          name: 'Currency',
        },
        {
          id: 'Date',
          name: 'Date',
        },
        {
          id: 'URL',
          name: 'URL',
        },

        {
          id: 'Checkbox',
          name: 'Checkbox',
        },
        {
          id: 'Single Select',
          name: 'Single Select',
        },
        {
          id: 'Multi Select',
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
      console.log('field');
      this.fieldType = field.name;
      isOpen = true;
      console.log(field);
    },
  },
};
</script>
