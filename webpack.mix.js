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

 mix.js('resources/js/app.js', 'public/js')
 .js('resources/js/backend/theme-scripts.js', 'public/js/backend');
//  .sass('resources/sass/app.scss', 'public/css');

/*
|--------------------------------------------------------------------------
| Backend Asset Management
|--------------------------------------------------------------------------
*/

mix.styles([
 'resources/css/backend/dashlite.css',
 'resources/css/backend/material-design-iconic-font.min.css',
 'resources/css/backend/pignose.calendar.css',
 'resources/css/backend/new-style.css',
], 'public/css/backend/theme.css');

mix.scripts([
 'resources/js/backend/nioapp.min.js',
 'resources/js/backend/scripts.js',
 'resources/js/backend/coundown.js',
 'resources/js/backend/pignose.calendar.full.min.js',
 'resources/js/backend/custom.js',
], 'public/js/backend/theme.js');


mix.copyDirectory('resources/fonts', 'public/css/fonts');
mix.copyDirectory('resources/web-fonts', 'public/css/web-fonts');


