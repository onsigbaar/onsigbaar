/**
 * rewrite-setting-seeder.js
 * Created by @anonymoussc on 6/5/2017 6:36 AM.
 */

'use strict';

let gulp   = require('gulp');
let config = require('./get-environment.js').config;


let tasks = {
    processing: processing
};

function processing() {
    return gulp.src([config.baseDirectory + '/' + config.fromComponents + '/Database/Seeds/SettingsTableSeeder.php']).pipe(gulp.dest('./database/seeds/'));
}

module.exports = tasks;