let mix = require('laravel-mix');
require('laravel-mix-obfuscator');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .obfuscator('public/js/app.js');
