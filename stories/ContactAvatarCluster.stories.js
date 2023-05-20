import ContactAvatarCluster from '../resources/js/components/ContactAvatarCluster.vue';

export default {
  title: 'Components/ContactAvatarCluster',
  component: ContactAvatarCluster,
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { ContactAvatarCluster },
  template: '<ContactAvatarCluster v-bind="$props" />',
});

export const Default = Template.bind({});
Default.args = {
  contacts: [
    { name: 'John Doe', avatarUrl: './john-doe.png' },
    { name: 'Jane Doe', avatarUrl: './jane-doe.png' },
  ],
};

export const ManyContacts = Template.bind({});
ManyContacts.args = {
  contacts: [
    { name: 'John Doe', avatarUrl: './john-doe.png' },
    { name: 'Jane Doe', avatarUrl: './jane-doe.png' },
    { name: 'Jim Doe', avatarUrl: './jim-doe.png' },
    { name: 'Jack Doe', avatarUrl: './jack-doe.png' },
    { name: 'Jill Doe', avatarUrl: './jill-doe.png' },
  ],
};
