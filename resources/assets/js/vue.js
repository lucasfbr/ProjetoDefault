import Vue from 'vue'

import VueResource from 'vue-resource'

Vue.use(VueResource)

import VcUsers from './components/users.vue';

new Vue({
    el: '#app',

    components:{
        VcUsers
    }
});

