require('./bootstrap');
window.Vue = require('vue');


import Vue from 'vue'
import App from './views/coordinador/App.vue'
import AppMaestro from './views/maestro/App.vue'
import Router from './routers/coordinador_router.js'
import RouterMaestro from './routers/maestro_router.js'
import CardAnimation from  './views/animations/CardTransition.vue'

import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'

Vue.component('card-transition', CardAnimation);

Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-right',
    defaultTimeout: 1000
})

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router 
});


const appMaestro = new Vue({
	el: '#app-maestro',
	components: { AppMaestro },
	router: RouterMaestro
});