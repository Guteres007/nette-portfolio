let mix = require('laravel-mix');

mix.js('assets/js/index.js', 'www/js');
mix.sass('assets/scss/index.scss', 'www/css')
    .sass('assets/scss/blog.scss', 'www/css')
    .sass('assets/scss/video.scss', 'www/css');
