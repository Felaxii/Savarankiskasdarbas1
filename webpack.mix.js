const mix = require('laravel-mix');

// Compile JavaScript and SCSS files
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// Bootstrap
mix.styles('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css')
   .scripts('node_modules/jquery/dist/jquery.js', 'public/js/jquery.js')
