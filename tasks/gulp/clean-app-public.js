/**
 * clean-app-public.js
 * Created by @anonymoussc on 6/5/2017 6:34 AM.
 */

'use strict';

let del    = require('del');
// eslint-disable-next-line no-unused-vars
let config = require('./get-environment.js').config;


let tasks = {
    processing: processing
};

function processing() {
    return del(['./storage/app/public/']).then(paths => {
        // eslint-disable-next-line no-console
        console.log('Deleting public app storage:\n', paths.join('\n'));
    });
}

module.exports = tasks;