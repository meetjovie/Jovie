import ContactAvatar from '../resources/js/components/ContactAvatar.vue';

export default {
  title: 'Components/ContactAvatar',
  component: ContactAvatar,
  argTypes: {
    contact: {
      control: {
        type: 'object',
      },
    },
    size: {
      control: {
        type: 'select',
        options: ['sm', 'md', 'lg'],
      },
    },
  },
};

const Template = (args, { argTypes }) => ({
  props: Object.keys(argTypes),
  components: { ContactAvatar },
  template: '<ContactAvatar v-bind="$props" />',
});

export const Default = Template.bind({});
Default.args = {
  contact: {
    id: 1,
    full_name: 'John Doe',
    profile_pic_url:
      'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
  },
};

export const NoImage = Template.bind({});
NoImage.args = {
  contact: {
    id: 2,
    full_name: 'Jane Doe',
  },
};

export const Updating = Template.bind({});
Updating.args = {
  contact: {
    id: 3,
    full_name: 'John Smith',
  },
  updating: true,
};

export const Editable = Template.bind({});
Editable.args = {
  contact: {
    id: 4,
    full_name: 'Jane Doe',
  },
  editable: true,
};

export const CustomSize = Template.bind({});
CustomSize.args = {
  contact: {
    id: 5,
    full_name: 'John Doe',
  },
  height: 16,
};

export const Loading = Template.bind({});
Loading.args = {
  loading: true,
};

export const UpdatingWithProgress = Template.bind({});
UpdatingWithProgress.args = {
  contact: {
    id: 6,
    full_name: 'John Smith',
  },
  updating: true,
  uploadProgress: 25,
};
