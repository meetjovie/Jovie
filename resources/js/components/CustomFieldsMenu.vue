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
          <InputGroup
              v-model="field.name"
            label="Field Name"
            type="text"
            :error="errors.name ? errors.name[0] : null"
            class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0" />

          <select
              v-model="field.type"
            class="w-full border-0 border-none border-transparent bg-transparent px-1 py-2 text-xs font-medium text-slate-600 outline-0 ring-0 placeholder:font-light placeholder:text-slate-400 focus:border-transparent focus:ring-0 focus:ring-transparent focus:ring-offset-0">
            <option v-for="fieldType in customFieldTypes" :value="fieldType.id">{{ fieldType.type }}</option>
          </select>
            <div v-if="errors.type" class="mt-2 text-xs text-red-600 dark:text-red-300">
                {{ errors.type[0] }}
            </div>
          <ButtonGroup text="Add Field" :disabled="adding" @click="saveCustomField" />
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
import InputGroup from './InputGroup.vue';
import ButtonGroup from './ButtonGroup.vue';
import FieldService from "../services/api/field.service";

export default {
  components: {
    PlusIcon,
    JovieDropdownMenu,
    GlassmorphismContainer,
    Popover,
    PopoverButton,
    PopoverPanel,
    Float,
    InputGroup,
    ButtonGroup,
  },
  data() {
    return {
      isOpen: true,
      fieldType: '',
      customFieldTypes: [],
        errors: {},
        field: {
          name: '',
          type: ''
        },
        adding: false
    };
  },
    mounted() {
      this.getCustomFieldTypes()
    },
  methods: {
      saveCustomField() {
          this.adding = true
          FieldService.saveCustomField(this.field).then((response) => {
              response = response.data;
              if (response.status) {
                  this.$notify({
                      group: 'user',
                      type: 'success',
                      duration: 40000,
                      title: 'Successful',
                      text: response.message,
                  });
                  this.field = {
                      name: '',
                      type: ''
                  }
              } else {
                  this.$notify({
                      group: 'user',
                      type: 'error',
                      duration: 15000,
                      title: 'Error',
                      text: response.message,
                  });
              }
          }).catch((error) => {
              if (error.response && error.response.status == 422) {
                  this.errors = error.response.data.errors;
              }
          }).finally((response) => {
              this.adding = false
          });
      },
      getCustomFieldTypes() {
          FieldService.getCustomFieldTypes().then((response) => {
              response = response.data;
              if (response.status) {
                  this.customFieldTypes = response.data
              } else {
                  this.$notify({
                      group: 'user',
                      type: 'error',
                      duration: 15000,
                      title: 'Error',
                      text: response.message,
                  });
              }
          }).catch((error) => {
          }).finally((response) => {
          });
      },
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
