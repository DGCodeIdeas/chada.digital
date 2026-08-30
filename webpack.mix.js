const mix = require('laravel-mix');

/*
 * Chada Digital — Asset Pipeline
 * Stack: Bootstrap 5 + Material Design 3 + Custom SCSS
 * Build tool: Laravel Mix (webpack) via Bun
 * Note: Tailwind CSS has been removed per founder directive.
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
