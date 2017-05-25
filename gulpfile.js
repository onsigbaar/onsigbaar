'use strict';

const elixir = require('laravel-elixir');
let del      = require('del');

require('laravel-elixir-eslint');
require('./tasks/swPrecache.task.js');
require('./tasks/bower.task.js');

let run = require('gulp-run-command').default;

// setting assets paths
elixir.config.assetsPath        = './';
elixir.config.css.folder        = 'components';
elixir.config.css.sass.folder   = 'components';
elixir.config.js.folder         = 'components';

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

let assets = [
        'public/js/final.js',
        'public/css/final.css'
    ],
    scripts = [
        'public/js/vendor.js', 'public/js/app.js'
    ],
    styles = [
        // for some reason, ./ prefix here works fine!
        // it is needed to override elixir.config.css.folder for styles mixin
        './public/css/vendor.css', './public/css/app.css'
    ],
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

    //enable front-end tests by adding the below task
    // .karma({jsDir: karmaJsDir});
});


/*------------------------------------------------------------------------------------------------*/

// let base = 'app', fromComponents = 'Components/Onsigbaar';
let base = 'vendor', fromComponents = 'consigliere/onsigbaar';

// Delete entire folder storage\app\public
gulp.task('clean-app-public', function () {
    return del(['./storage/app/public/']).then(paths => {
        console.log('Deleting public app storage:\n', paths.join('\n'));
    });
});

// Copying view resources
gulp.task('cp-gb', function () {

    gulp.src(['./' + base + '/' + fromComponents + '/Publish/js/*.*']).pipe(gulp.dest('./public/js/'));
    gulp.src(['./' + base + '/' + fromComponents + '/Publish/css/*.*']).pipe(gulp.dest('./public/css/'));

    return gulp.src(['./' + base + '/' + fromComponents + '/Publish/storage/app/public/**/*.*']).pipe(gulp.dest('./storage/app/public/'));
});

gulp.task('rw-assets', function () {
    return gulp.src(['./' + base + '/' + fromComponents + '/Publish/vendor/voyager/public/vendor/tcg/voyager/assets/**/**/*.*']).pipe(gulp.dest('./public/vendor/tcg/voyager/assets/'));
});

gulp.task('rw-settingseeder', function () {
    return gulp.src(['./' + base + '/' + fromComponents + '/Database/Seeds/SettingsTableSeeder.php']).pipe(gulp.dest('./database/seeds/'));
});

gulp.task('app-install', function () {

    gulp.src(['./' + base + '/' + fromComponents + '/Publish/js/*.*']).pipe(gulp.dest('./public/js/'));
    gulp.src(['./' + base + '/' + fromComponents + '/Publish/css/*.*']).pipe(gulp.dest('./public/css/'));
    gulp.src(['./' + base + '/' + fromComponents + '/Publish/vendor/passport/database/migrations/*.*']).pipe(gulp.dest('./database/migrations/'));
    gulp.src(['./' + base + '/' + fromComponents + '/Publish/vendor/voyager/database/migrations/*.*']).pipe(gulp.dest('./database/migrations/'));
    gulp.src(['./' + base + '/' + fromComponents + '/Publish/vendor/voyager/database/seeds/*.*']).pipe(gulp.dest('./database/seeds/'));

    return gulp.src(['./' + base + '/' + fromComponents + '/Publish/storage/app/public/**/*.*']).pipe(gulp.dest('./storage/app/public/'));
});