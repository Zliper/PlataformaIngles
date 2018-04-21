import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import App from '../views/coordinador/App.vue'
import Reactivo from '../views/coordinador/Reactivo.vue'
import Grupo from '../views/coordinador/Grupo.vue'
import Materia from '../views/coordinador/Materia'
import Punto from '../views/coordinador/Punto'
import Index from '../views/coordinador/Index.vue'
import GrupoDetails from '../views/coordinador/GrupoDetail.vue'

import Cuestionario from "../views/global/Cuestionario.vue"

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [	
        {
            path: '/coordinador',
            name: 'index',
            component: Index
        },	
        {
            path: '/coordinador/reactivos',
            name: 'reactivos',
            component: Reactivo
        },
        {
            path: '/coordinador/materias',
            name: 'materias',
            component: Materia
        },
        {
            path: '/coordinador/cuestionarios',
            name: 'cuestionarios',
            component: Cuestionario
        },
        {
        	path: '/coordinador/grupos',
        	name: 'grupos',
        	component: Grupo
        },
        {
            path: '/coordinador/grupos/:grupoId/show',
            name: 'grupoDetails',
            component: GrupoDetails,
            props: true,
        },
        {
            path: '/coordinador/puntos',
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