import Pagination from '../resources/js/components/Pagination.vue';

export default {
  title: 'Components/Pagination',
  component: Pagination,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { Pagination },
  template: '<pagination v-bind="$props" />',
});

export const Default = Template.bind({});
Default.args = {
  total: 100,
  perPage: 10,
};

export const FewPages = Template.bind({});
FewPages.args = {
  total: 30,
  perPage: 10,
};

export const ManyPages = Template.bind({});
ManyPages.args = {
  total: 1000,
  perPage: 10,
};
