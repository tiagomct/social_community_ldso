const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');


elixir(function (mix) {
    mix.sass('app.scss', 'public/css/app.css');
    mix.sass('auth.scss', 'public/css/auth.css');

    mix.browserify('app.js', 'public/js/app.js');

    mix.version([
        'public/css/app.css',
        'public/css/auth.css',
        'public/js/app.js'
    ]);
});