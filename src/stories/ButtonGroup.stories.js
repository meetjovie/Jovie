import ButtonGroup from './ButtonGroup.vue';
import JovieSpinner from './JovieSpinner.vue';
export default {
  title: 'ButtonGroup',
  components: { ButtonGroup, JovieSpinner },
  //add prop for checked
  argTypes: {
    text: {
      control: {
        type: 'text',
      },
    },
    error: {
      options: [true, false],
      control: {
        type: 'boolean',
      },
    },
  },
};

export const Default = () => ({
  components: { ButtonGroup },
  template: '<ButtonGroup text="ClickMe" />',
  props: {
    text: {
      default: 'ClickMe',
    },
  },
});
