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
   .scripts([
      'node_modules/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js',
      'node_modules/startbootstrap-sb-admin-2/js/sb-admin-2.js'
   ], 'public/js/all.js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('node_modules/startbootstrap-sb-admin-2/scss/sb-admin-2.scss', 'public/css');
   
