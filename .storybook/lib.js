import {
  boolean,
  number,
  text,
  object,
  color,
  array,
  select,
  radios,
  files,
  date,
  button,
} from '@storybook/addon-knobs';
import { action } from '@storybook/addon-actions';
import { storiesOf } from '@storybook/vue3';

export function buildStories(component) {
  storiesOf(component.story.category, module).add(component.story.name, () => {
    makePropsDynamic(component);

    return component;
  });
}

function makePropsDynamic(vueComponent) {
  const props = Object.keys(vueComponent.props);

  for (const propName of props) {
    const prop = vueComponent.props[propName];
    const story = prop.story || {};
    const category = story.category || 'All';
    const displayedName = story.name || capitalize(propName);

    switch (story.type || prop.type.name) {
      case 'Action':
        prop.default = action(displayedName);
        break;
      case 'Array':
        prop.default = array(displayedName, prop.default, ',', category);
        break;
      case 'Button':
        prop.default = button(displayedName, prop.default, category);
        break;
      case 'Boolean':
        prop.default = boolean(displayedName, prop.default, category);
        break;
      case 'Color':
        prop.default = color(displayedName, prop.default, category);
        break;
      case 'Date':
        prop.default = date(displayedName, prop.default, category);
        break;
      case 'Files':
        prop.default = files(
          displayedName,
          story.options || '*',
          prop.default,
          category
        );
        break;
      case 'Number':
        prop.default = number(
          displayedName,
          prop.default,
          story.options || {},
          category
        );
        break;
      case 'Object':
        prop.default = object(displayedName, prop.default, category);
        break;
      case 'Radios':
        prop.default = radios(
          displayedName,
          story.options || {},
          prop.default,
          category
        );
        break;
      case 'Select':
        prop.default = select(
          displayedName,
          story.options || {},
          prop.default,
          category
        );
        break;
      case 'String':
      case 'Text':
        prop.default = text(displayedName, prop.default, category);
        break;
    }
  }

  function capitalize(string) {
    return string[0].toUpperCase() + string.slice(1);
  }
}
