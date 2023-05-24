import ButtonGroup from '../resources/js/components/ButtonGroup.vue';

export default {
  title: 'Components/ButtonGroup',
  component: ButtonGroup,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { ButtonGroup },
  template: '<button-group v-bind="$props" />',
});

export const Primary = Template.bind({});
Primary.args = {
  text: 'Click me',
  loading: false,
};

export const Secondary = Template.bind({});
Secondary.args = {
  text: 'Saving...',
  loader: true,
};
