let mix = require('laravel-mix');
mix.setPublicPath('assets');

// mix.copy('resources/images', 'assets/images');
mix.sass('./resources/sass/apt-pricing-table.scss', './assets/css/aptfe-pricing-table.css');
