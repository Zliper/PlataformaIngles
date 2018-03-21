import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import App from '../views/coordinador/App.vue'
import Reactivo from '../views/coordinador/Reactivo.vue'
import Grupo from '../views/coordinador/Grupo.vue'
import Materia from '../views/coordinador/Materia'
import Punto from '../views/coordinador/Punto'
import Index from '../views/coordinador/Index.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [	
        {
            path: '/',
            name: 'index',
            component: Index
        },	
        {
            path: '/reactivos',
            name: 'reactivos',
            component: Reactivo
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
            path: '/puntos',
            name: 'puntos',
            component: Punto
        },

        {
            path: "*",
            component: PageNotFound
        }
	],
});

export default router