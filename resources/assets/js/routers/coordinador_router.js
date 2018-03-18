import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import App from '../views/coordinador/App.vue'
import Home from '../views/coordinador/Home.vue'
import Grupo from '../views/coordinador/Grupo.vue'
import Materia from '../views/coordinador/Materia'

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
            path: '/materias',
            name: 'materias',
            component: Materia
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