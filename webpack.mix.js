let mix = require('laravel-mix');

/*
 |------<--------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js');
mix.js('resources/assets/js/payBill.js', 'public/js');
mix.js('resources/assets/js/adminpanel.js', 'public/js');
mix.js('resources/assets/js/typeahead.js', 'public/js');
mix.js('resources/assets/js/autofill.js', 'public/js');
