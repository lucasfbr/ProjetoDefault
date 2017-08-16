var Vue = require('vue');
var system = require('./system');
var methods = require('./methods');
var data = require('./data');

//Vue.use(require('vue-resource'));

module.exports = new Vue({

    el: '#auth',
    data: data,
    methods: methods,
    ready: system.ready


});
