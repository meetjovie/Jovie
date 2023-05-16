/* import { buildStories } from '/Users/timwhite/Documents/GitHub/Jovie/.storybook/lib.js'; */
import { buildStories } from '../../../.storybook/lib.js';

const stories = require.context('./', true, /\.story\.vue$/);

stories.keys().forEach((story) => {
  buildStories(stories(story).default);
});
export default {
  /* 👇 The title prop is optional.
   * See https://storybook.js.org/docs/vue/configure/overview#configure-story-loading
   * to learn how to generate automatic titles
   */
  title: 'Path/To/MyComponent',
  component: MyComponent,
};
