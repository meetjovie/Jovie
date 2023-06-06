import TemplateModal from '../resources/js/components/TemplateModal.vue';

export default {
  title: 'TemplateModal',
  component: TemplateModal,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { TemplateModal },
  template: '<template-modal v-bind="$props" />',
});

export const Default = Template.bind({});
Default.args = {
  // Props for the component
};
