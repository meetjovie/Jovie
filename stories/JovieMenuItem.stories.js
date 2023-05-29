import JovieMenuItem from '../resources/js/components/JovieMenuItem.vue';

export default {
  title: 'Components/JovieMenuItem',
  component: JovieMenuItem,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { JovieMenuItem },
  template: '<jovie-menu-item v-bind="$props" />',
});

export const Default = Template.bind({});
Default.args = {
  /* 👇 The args you need here will depend on your component */
};

export const Primary = Template.bind({});
Primary.args = {
  /* 👇 The args you need here will depend on your component */
};

export const Secondary = Template.bind({});
Secondary.args = {
  /* 👇 The args you need here will depend on your component */
};
