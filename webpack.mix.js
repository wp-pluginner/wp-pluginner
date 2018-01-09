let mix = require('laravel-mix');

mix.setPublicPath('public')
   .js('resource/asset/js/app.js', 'js')
   .sass('resource/asset/sass/app.scss', 'css')
   .version();
