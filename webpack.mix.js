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


// Backend css
mix.sass(
    'resources/css/backend/scss/sb-admin-2.scss',
 'public/css/backend/all.css');

// Backend Javascript
mix.scripts([
    'resources/js/vendor/bootstrap/js/bootstrap.js',
    'resources/js/vendor/datatables/dataTables.bootstrap4.js',
    'resources/js/vendor/datatables/jquery.dataTables.js',
    'resources/js/backend/sb-admin.js',
], 'public/js/backend/all.js');

