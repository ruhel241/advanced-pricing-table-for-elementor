let mix = require('laravel-mix');
mix.setPublicPath('assets');

// mix.copy('resources/images', 'assets/images');
mix.sass('./resources/sass/apt-pricing-table.scss', './assets/css/apt-pricing-table.css');
// mix.sass('./resources/sass/atc-editor.scss', './assets/css/atc-editor.css');
// mix.js('resources/js/atc-testimonial.js', 'assets/js/atc-testimonial.js');