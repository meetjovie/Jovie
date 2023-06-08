<template>
  <GlassmorphismContainer size="3xl">
    <div class="px-8 py-2">
      <div
        class="fond-semibold dark:font-white flex flex-col text-xs text-slate-700 dark:text-jovieDark-100">
        <span class="text-xl">Start with a template</span>
        Jumpstart your list with one of these templates created by experts
      </div>

      <div class="relative py-4">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div class="w-full border-t border-gray-300" />
        </div>
        <div class="relative flex justify-start">
          <span
            class="bg-slate-50/90 pr-3 text-base font-semibold leading-6 text-slate-900 dark:bg-jovieDark-900 dark:text-jovieDark-100"
            >Popular templates</span
          >
        </div>
      </div>
      <ActionListGrid @selected="templateSelected" :actions="templates" />
      <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
        <button
          :disabled="updating || !selectedTemplate"
          type="button"
          :class="
            modalLayout == 'alert'
              ? 'bg-red-600 hover:bg-red-700'
              : 'bg-indigo-600 hover:bg-indigo-700'
          "
          class="inline-flex w-full justify-center rounded-md border border-transparent px-4 py-2 text-base font-medium text-white shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
          @click="setTemplate">
          Update Template
        </button>
        <button
          :disabled="updating"
          @click="closeModel"
          type="button"
          class="mt-3 inline-flex w-full justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-base font-medium text-slate-700 shadow-sm hover:bg-slate-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 sm:ml-3 sm:mt-0 sm:w-auto sm:text-sm"
          ref="cancelButtonRef">
          Cancel
        </button>
      </div>
    </div>
  </GlassmorphismContainer>
</template>

<script>
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import ActionListGrid from './ActionListGrid.vue';
import TemplateService from '../services/api/template.service';

export default {
  components: {
    GlassmorphismContainer,
    ActionListGrid,
  },
  props: ['templates', 'list'],
  data: function () {
    return {
      updating: false,
      selectedTemplate: null,
    };
  },
  methods: {
    templateSelected(item) {
      this.selectedTemplate = item;
    },
    closeModel() {
      this.$emit('cancel');
    },
    setTemplate() {
      let data = {
        template_id: this.selectedTemplate,
        list_id: this.list,
      };
      this.updating = true;
      TemplateService.setTemplate(data)
        .then((response) => {
          response = response.data;
          if (response.status) {
            this.$emit('updated');
            this.$notify({
              group: 'user',
              type: 'success',
              duration: 15000,
              title: 'Successful',
              text: response.message,
            });
          }
        })
        .catch((error) => {
          this.$notify({
            group: 'user',
            type: 'error',
            duration: 15000,
            title: 'Failed',
            text: error.message,
          });
        })
        .finally(() => {
          this.updating = false;
        });
    },
  },
};
</script>
