import JovieSpinner from './JovieSpinner.vue';

export default {
  title: 'Components/JovieSpinner',
  component: JovieSpinner,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { JovieSpinner },
  template: '<jovie-spinner v-bind="$props" />',
});

export const Primary = Template.bind({});
Primary.args = {
  spinnerColor: 'blue',
  spinnerSize: 'sm',
};

export const Secondary = Template.bind({});
Secondary.args = {
  spinnerSize: 'lg',
  spinnerColor: 'red',
};
