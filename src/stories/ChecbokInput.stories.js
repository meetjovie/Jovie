import CheckboxInput from './CheckboxInput.vue';
export default {
  /* 👇 The title prop is optional.
   * See https://storybook.js.org/docs/vue/configure/overview#configure-story-loading
   * to learn how to generate automatic titles
   */
  title: 'Inputs/CheckboxInput',
  component: CheckboxInput,
  //add prop for checked
  argTypes: {
    checked: {
      options: [true, false],
      control: {
        type: 'boolean',
      },
    },
  },
};

export const Checked = () => ({
  components: { CheckboxInput },
  template: '<CheckboxInput checked="true" />',
  props: {
    checked: {
      default: true,
    },
  },
});
export const Unchecked = () => ({
  components: { CheckboxInput },
  template: '<CheckboxInput checked="false" />',
  props: {
    checked: {
      default: false,
    },
  },
});
