/**
 * get-environment.js
 * Created by @anonymoussc on 6/4/2017 4:34 PM.
 */

'use strict';

let tasks = {
    config: config()
};

function config() {
    let cfg;

    // eslint-disable-next-line no-undef
    if (process.env.APP_ENV === 'dev-local') {
        cfg = require('./../config/taskCfg.dev-local.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'local') {
        cfg = require('./../config/taskCfg.local.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'development') {
        cfg = require('./../config/taskCfg.development.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'integration') {
        cfg = require('./../config/taskCfg.integration.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'testing') {
        cfg = require('./../config/taskCfg.testing.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'staging') {
        cfg = require('./../config/taskCfg.staging.js');
        // eslint-disable-next-line no-undef
    } else if (process.env.APP_ENV === 'production') {
        cfg = require('./../config/taskCfg.production.js');
    }

    return cfg;
}

module.exports = tasks;