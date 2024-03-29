const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');



   const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

   mix.webpackConfig({
      plugins: [
          new BrowserSyncPlugin({
              files: [
                  'app/**/*',
                  'public/**/*',
                  'resources/views/**/*',
                  'routes/**/*'
              ]
          })
      ]
   });


   //  host: 'sipag.test',
   //  proxy: 'sipag.test',
   //  files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php', 'public/js/*.js', 'public/css/*.css']);
