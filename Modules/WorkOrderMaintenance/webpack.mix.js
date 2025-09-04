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

mix.setPublicPath('../../public').setResourceRoot('../');

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/configuratebase.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'css/configuratebase.css');

if (mix.inProduction()) {
    mix.version();
}
