require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({

    el: '#app',

    methods: {

        printme(){

            window.print()

        }
    }
});