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
    'public/css/backend/all.css'
);

// Backend Javascript
mix.scripts([
    'resources/vendor/jquery/jquery.min.js',
    'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/vendor/jquery-easing/jquery.easing.min.js',
    'resources/js/backend/sb-admin-2.js',
    'resources/js/backend/summernote-bs4.js',
    'resources/vendor/datatables/jquery.dataTables.min.js',
    'resources/vendor/jquery-easing/jquery.easing.min.js',
    'resources/vendor/datatables/dataTables.bootstrap4.min.js',
    'resources/vendor/chart.js/Chart.bundle.min.js',
], 'public/js/backend/all.js');

