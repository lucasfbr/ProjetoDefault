var Vue = require('vue');
var system = require('./system');
var methods = require('./methods');
var data = require('./data');

Vue.use(require('vue-resource'));

module.exports = new Vue({

    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el: '#painel',
    data: data,
    methods: methods,
    ready: system.ready


});
