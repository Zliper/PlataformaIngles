require('./bootstrap');
window.Vue = require('vue');


import Vue from 'vue'
import App from './views/coordinador/App.vue'
import AppMaestro from './views/maestro/App.vue'
import AppAlumno from './views/alumno/App.vue'
import Router from './routers/coordinador_router.js'
import RouterMaestro from './routers/maestro_router.js'
import RouterAlumno from './routers/alumno_router.js'
import CardAnimation from  './views/animations/CardTransition.vue'

import VueToastr from '@deveodk/vue-toastr'
import '@deveodk/vue-toastr/dist/@deveodk/vue-toastr.css'

const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)

Vue.component('card-transition', CardAnimation);

Vue.use(VueToastr, {
    defaultPosition: 'toast-bottom-right',
    defaultTimeout: 3000
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

const appAlumno = new Vue({
	el: '#app-alumno',
	components: { AppAlumno },
	router: RouterAlumno
});