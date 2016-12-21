const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');


elixir(function (mix) {
    mix.sass('app.scss', 'public/css/app.css');

    //mix.browserify('app.js', 'public/js/app.js');
    mix.scripts([
        'services/jquery.min.js',
        'services/bootstrap.min.js',
        'services/jquery.nicescroll.min.js',
        'services/superfish.min.js',
        'services/jquery.flexslider-min.js',
        'services/owl.carousel.js',
        'services/animate.js',
        'template.js'
    ], 'public/js/template.js');

    mix.version([
        'public/css/app.css',
        'public/js/template.js'
    ]);
});