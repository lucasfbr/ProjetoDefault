var Vue = require('vue');
var system = require('./system');
var methods = require('./methods');
var data = require('./data');
var computed = require('./computed');

Vue.use(require('vue-resource'));

module.exports = new Vue({

    /*http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },*/

    el: '#painel',
    data: data,
    methods: methods,
    computed: computed,
    ready: system.ready


});
