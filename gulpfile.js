'use strict';

const elixir = require('laravel-elixir');

require('laravel-elixir-eslint');
require('./tasks/swPrecache.task.js');
require('./tasks/bower.task.js');
require('dotenv').config();

let gulp = require('gulp');
// eslint-disable-next-line no-unused-vars
let run  = require('gulp-run-command').default;
// eslint-disable-next-line no-unused-vars
let del  = require('del');

// setting assets paths
elixir.config.assetsPath      = './';
elixir.config.css.folder      = 'components';
elixir.config.css.sass.folder = 'components';
elixir.config.js.folder       = 'components';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

let assets     = [
        'public/js/final.js',
        'public/css/final.css'
    ],
    scripts    = [
        'public/js/vendor.js', 'public/js/app.js'
    ],
    styles     = [
        // for some reason, ./ prefix here works fine!
        // it is needed to override elixir.config.css.folder for styles mixin
        './public/css/vendor.css', './public/css/app.css'
    ],
    // eslint-disable-next-line no-unused-vars
    karmaJsDir = [
        'public/js/vendor.js',
        'node_modules/angular-mocks/angular-mocks.js',
        'node_modules/ng-describe/dist/ng-describe.js',
        'public/js/app.js',
        'tests/components/**/*.spec.js'
    ];

elixir(mix => {
    mix.bower()
        .copy('components/app/**/*.html', 'public/views/app/')
        .copy('components/dialogs/**/*.html', 'public/views/dialogs/')
        .webpack('index.main.js', 'public/js/app.js')
        .sass(['**/*.scss', 'critical.scss'], 'public/css')
        .sass('critical.scss', 'public/css/critical.css')
        .styles(styles, 'public/css/final.css')
        .eslint('components/**/*.js')
        .combine(scripts, 'public/js/final.js')
        .version(assets)
        .swPrecache();

    // enable front-end tests by adding the below task
    // .karma({jsDir: karmaJsDir});
});


gulp.task('app-install', require('./tasks/run/app-install.js').processing);
gulp.task('clean-app-public', require('./tasks/run/clean-app-public.js').processing);
gulp.task('copy-publish', require('./tasks/run/copy-publish.js').processing);
gulp.task('rewrite-assets', require('./tasks/run/rewrite-assets.js').processing);
gulp.task('rewrite-setting-seeder', require('./tasks/run/rewrite-setting-seeder.js').processing);