/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin');
const { tailwindcssOriginSafelist } = require('@headlessui-float/vue');
const path = require('path');

module.exports = {
  content: [
    './public/**/*.html',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    path.join(__dirname, './src/**/*.(js|jsx|ts|tsx)'),
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './node_modules/vue-tailwind-datepicker/**/*.js',
  ],
  darkMode: 'class',
  safelist: [...tailwindcssOriginSafelist],
  theme: {
    extend: {
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
      },
      animation: {
        'spin-slow': 'spin 3s linear infinite',
      },
      aspectRatio: {
        auto: 'auto',
        square: '1 / 1',
        video: '16 / 9',
        1: '1',
        2: '2',
        3: '3',
        4: '4',
        5: '5',
        6: '6',
        7: '7',
        8: '8',
        9: '9',
        10: '10',
        11: '11',
        12: '12',
        13: '13',
        14: '14',
        15: '15',
        16: '16',
      },
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        'vtd-primary': colors.sky, // Light mode Datepicker color
        'vtd-secondary': colors.gray, // Dark mode Datepicker color
        jovieDark: {
          DEFAULT: '#575BC7',
          50: '#f6f6f9',
          100: '#ecedf2',
          200: '#d5d6e2',
          300: '#b0b4c9',
          400: '#94a3b8',
          500: '#323743',
          600: '#2A2935',
          700: '#20232E',
          800: '#1B1D2A',
          900: '#191A22',
          border: '#3B3B4E',
        },

        slate: colors.neutral,
        social: {
          facebook: '#3b5998',
          twitter: '#1da1f2',
          twitch: '#6441a5',
          instagram: '#e1306c',
          youtube: '#c4302b',
          linkedin: '#0077b5',
          pinterest: '#bd081c',
          github: '#333',
          behance: '#2b547e',
          dribbble: '#ea4c89',
          vimeo: '#1ab7ea',
          soundcloud: '#ff7700',
          vk: '#4c75a3',
          reddit: '#ff4500',
          discord: '#7289da',
          skype: '#00aff0',
          whatsapp: '#25d366',
          telegram: '#00e676',
          snapchat: '#fffc00',
          tiktok: '#ff0050',
          tiktok2: '#00f2ea',
        },
      },
      fontSize: {
        '2xs': '.65rem',
        xs: '.75rem',
        sm: '.875rem',
        base: '1rem',
        lg: '1.125rem',
        xl: '1.25rem',
        '2xl': '1.5rem',
        '3xl': '1.875rem',
        '4xl': '2.25rem',
        '5xl': '3rem',
        '6xl': '4rem',
        '7xl': '5rem',
      },

      spacing: {
        128: '32rem',
        192: '48rem',
        256: '64rem',
      },
    },
  },
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/typography'),
    require('tailwind-scrollbar-hide'),

    // ...
  ],
};
