/**
 * rewrite-assets.js
 * Created by @anonymoussc on 6/5/2017 6:35 AM.
 */

'use strict';

let gulp   = require('gulp');
let config = require('./get-environment.js').config;


let tasks = {
    processing: processing
};

function processing() {
    return gulp.src([config.baseDirectory + '/' + config.fromComponent + '/Publish/vendor/voyager/public/vendor/tcg/voyager/assets/**/**/*.*']).pipe(gulp.dest('./public/vendor/tcg/voyager/assets/'));
}

module.exports = tasks;