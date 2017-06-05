/**
 * app-install.js
 * Created by @anonymoussc on 6/5/2017 6:34 AM.
 */

'use strict';

let gulp   = require('gulp');
let config = require('./get-environment.js').config;


let tasks = {
    processing: processing
};

function processing() {
    gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/js/*.*']).pipe(gulp.dest('public/js/'));
    gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/css/*.*']).pipe(gulp.dest('public/css/'));
    gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/vendor/voyager/database/migrations/*.*']).pipe(gulp.dest('database/migrations/'));
    gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/vendor/voyager/database/seeds/*.*']).pipe(gulp.dest('database/seeds/'));

    return gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/storage/app/public/**/*.*']).pipe(gulp.dest('storage/app/public/'));
}

module.exports = tasks;