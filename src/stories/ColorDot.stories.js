import ColorDot from './ColorDot.vue';
export default {
  /* 👇 The title prop is optional.
   * See https://storybook.js.org/docs/vue/configure/overview#configure-story-loading
   * to learn how to generate automatic titles
   */
  title: 'ColorDot',
  component: ColorDot,
  argTypes: {
    color: {
      control: {
        type: 'select',
        options: ['red', 'blue', 'green', 'yellow', 'orange'],
      },
    },
  },
};
export const Orange = () => ({
  components: { ColorDot },
  template: '<ColorDot color="orange" />',
  props: {
    color: {
      default: 'blue',
    },
  },
});
