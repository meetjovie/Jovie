import JovieDatePicker from './JovieDatePicker.vue';
import GlassmorphismContainer from './GlassmorphismContainer.vue';
import { CalendarDaysIcon } from '@heroicons/vue/24/solid';
export default {
  title: 'Inputs/JovieDatePicker',
  components: { JovieDatePicker, GlassmorphismContainer, CalendarDaysIcon },
  argTypes: {
    date: {
      control: {
        type: 'date',
      },
    },
  },
};
export const Default = () => ({
  components: { JovieDatePicker, GlassmorphismContainer, CalendarDaysIcon },
  template: '<JovieDatePicker />',
  props: {
    date: {
      default: null,
    },
  },
});
