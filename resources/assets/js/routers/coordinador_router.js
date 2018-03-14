import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import App from '../views/coordinador/App.vue'
import Home from '../views/coordinador/Home.vue'
import Grupo from '../views/coordinador/Grupo.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
            path: '/',
            name: 'home',
            component: Home
        },
        {
        	path: '/grupos',
        	name: 'grupos',
        	component: Grupo
        },
        {
            path: "*",
            component: PageNotFound
        }
	],
});

export default router