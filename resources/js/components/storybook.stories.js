/* import { buildStories } from '/Users/timwhite/Documents/GitHub/Jovie/.storybook/lib.js'; */
import { buildStories } from '../../../.storybook/lib.js';

const stories = require.context('./', true, /\.story\.vue$/);
stories.keys().forEach((story) => {
  buildStories(stories(story).default);
});
