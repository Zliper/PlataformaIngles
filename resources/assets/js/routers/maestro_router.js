import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import Home from '../views/maestro/Home.vue'


Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [		{
            path: '/maestro',
            name: 'home',
            component: Home
        },
        {
            path: "*",
            component: PageNotFound
        }
	],
});

export default router