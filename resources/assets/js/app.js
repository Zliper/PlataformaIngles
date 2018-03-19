require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'
import App from './views/coordinador/App.vue'
import Router from './routers/coordinador_router.js'


Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-right',
    defaultTimeout: 1000
})

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router 
});
