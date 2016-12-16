const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');


elixir(function (mix) {
    mix.sass('app.scss', 'public/css/app.css');
    mix.sass('auth.scss', 'public/css/auth.css');
    //mix.sass('userProfile.scss', 'public/css/userProfile.css');
    //mix.sass('usersList.scss', 'public/css/usersList.css');
    mix.sass('referendumShow.scss', 'public/css/referendumShow.css');

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
        'public/css/auth.css',
        //'public/css/userProfile.css',
        //'public/css/usersList.css',
        'public/css/referendumShow.css',
        'public/js/template.js'
    ]);
});