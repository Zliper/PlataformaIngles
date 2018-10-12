import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import Index from '../views/alumno/Index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [		
        {
            path: '/alumno',
            name: 'index',
            component: Index
        },
        {
            path: "*",
            component: PageNotFound
        }
	],
});

export default router