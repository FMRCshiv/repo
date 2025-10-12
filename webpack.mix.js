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

// Theme assets
mix.js('resources/js/theme.js', 'public/themes/blizzard/js/theme.js')
   .sass('resources/sass/theme.scss', 'public/themes/blizzard/css/theme.css')
   .options({
       processCssUrls: false,
       postCss: [
           require('tailwindcss'),
           require('autoprefixer'),
       ],
   });

// Copy additional assets
mix.copyDirectory('resources/images', 'public/themes/blizzard/images');

// Version files in production
if (mix.inProduction()) {
    mix.version();
}

// Source maps for development
if (!mix.inProduction()) {
    mix.sourceMaps();
}
