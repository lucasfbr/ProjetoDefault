
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        user: []
    },
    ready: function () {

        var self = this;

        self.$http.get('http://localhost:8000/list').then(function (response) {

            var aux = [];

            for(var k in response.data) {

                self.user.push(response.data[k]);
            }

        })

    }
});



