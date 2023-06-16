const mix = require('laravel-mix');

require('vuetifyjs-mix-extension');

if (mix.inProduction()) {
    mix.options({
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_console: true,
                }
            }
        },
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true
                }
            }
        }
    });
}

mix.webpackConfig({
    resolve      : { symlinks: false },
    watchOptions : { ignored: /node_modules/ },
    output       : { publicPath: '/', chunkFilename: '[name].js?[hash]' },
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');
mix.js('resources/js/admin.js', 'public/js').vuetify().vue();
mix.js('resources/js/site.js', 'public/js').vue();
mix.sass('resources/sass/admin.sass', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
