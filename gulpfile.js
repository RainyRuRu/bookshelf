var elixir = require('laravel-elixir');

elixir(function (mix) {

    mix.sass('*.scss')
        .browserSync({
             proxy: 'homestead.app',
                reloadDelay: 2000
        });
     
});
