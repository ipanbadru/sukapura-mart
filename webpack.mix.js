const mix = require('laravel-mix');

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

 mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.copy('node_modules/slim-select/dist/slimselect.js', 'public/js/slim-select.js');
mix.copy('node_modules/slim-select/dist/slimselect.css', 'public/css/slim-select.css');
mix.copy('node_modules/chart.js/dist/chart.js', 'public/js/chart.js');