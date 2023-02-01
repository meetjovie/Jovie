//create a storybook for the GlassmorphismContainer component
//
// Path: src/stories/GlassmorphismContainer.stories.js
// Compare this snippet from src/stories/JovieDatePicker.stories.js:
import GlassmorphismContainer from './GlassmorphismContainer.vue';
export default {
  title: 'Containers/GlassmorphismContainer',
  component: GlassmorphismContainer,
};
export const Default = () => ({
  components: { GlassmorphismContainer },
  template: '<GlassmorphismContainer />',
});
export const WithText = () => ({
  components: { GlassmorphismContainer },
  template: '<GlassmorphismContainer>With Text</GlassmorphismContainer>',
});
