const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const path = require('path');
const Vapor = require('laravel-vapor');
require('laravel-mix-webp');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.browserSync('127.0.0.1');

mix.ImageWebp({
  from: 'resources/img',
  to: 'public/img',
});

mix
  .js('resources/js/app.js', 'public/js')
  .vue()
  .postCss('resources/css/app.css', 'public/css', [require('tailwindcss')]);

if (mix.inProduction()) {
  mix.options({
    terser: {
      terserOptions: {
        compress: {
          drop_console: true,
        },
      },
    },
  });
  mix.version();
}

mix.alias({
  '@': path.join(__dirname, 'resources/js'),
});

if (mix.inProduction()) {
  const ASSET_URL = process.env.ASSET_URL + '/';

  mix.webpackConfig((webpack) => {
    return {
      plugins: [
        new webpack.DefinePlugin({
          'process.env.ASSET_PATH': JSON.stringify(ASSET_URL),
        }),
      ],
      output: {
        publicPath: ASSET_URL,
      },
    };
  });
}
