var Vue = require('vue');
var filters = require('../filters/filters');
var system = require('./system');
var methods = require('./methods');
var data = require('./data');

Vue.use(require('vue-resource'));

Vue.filter('formatDate', filters.formatDate);

module.exports = new Vue({

    el: '#portal',
    data: data,
    methods: methods,
    ready: system.ready

});



