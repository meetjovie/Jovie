import { storiesOf } from '@storybook/vue';

const stories = require.context('./', true, /\.story\.vue$/);
stories.keys().forEach((story) => {
  const component = stories(story).default;
  storiesOf(component.story.category, module).add(
    component.story.name,
    () => component
  );
});
