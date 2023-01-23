import JovieSpinner from './JovieSpinner.vue';
export default {
  title: 'JovieSpinner',
  component: JovieSpinner,
  argTypes: {
    spinnerColor: {
      control: {
        type: 'select',
        options: ['red', 'blue', 'green', 'yellow', 'orange'],
      },
    },
  },
};
export const Orange = () => ({
  components: { JovieSpinner },
  template: '<JovieSpinner />',
  props: {
    spinnerColor: {
      default: 'orange',
    },
    spinnerSize: {
      default: 'large',
    },
  },
});
