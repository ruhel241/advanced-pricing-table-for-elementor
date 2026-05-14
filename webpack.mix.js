let mix = require('laravel-mix');
mix.setPublicPath('assets');

mix.copy('resources/images', 'assets/images');
mix.sass('./resources/sass/aptfe-pricing-table.scss', './assets/css/aptfe-pricing-table.css');
mix.sass('./resources/sass/aptfe-admin.scss', './assets/css/aptfe-admin.css');