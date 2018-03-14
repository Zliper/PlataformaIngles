require('./bootstrap');
window.Vue = require('vue');

import App from './views/coordinador/App.vue'
import Router from './routers/coordinador_router.js'

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router 
});
