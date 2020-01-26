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
mix.styles([
    'resources/css/backend/dataTables.bootstrap4.css',
    'resources/css/backend/sb-admin-2.css',
    'resources/css/backend/summernote-bs4.css',
], 'public/css/backend/all.css');

// Backend Javascript
mix.scripts([
    'resources/js/backend/all.js',
    'resources/js/backend/chart.js/Chart.min.js',
], 'public/js/backend/all.js');

