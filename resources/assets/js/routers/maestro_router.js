import Vue from 'vue'
import VueRouter from 'vue-router'

import PageNotFound from '../views/errors/404.vue'

import Index from '../views/maestro/Index.vue'
import Home from '../views/maestro/Home.vue'
import Reactivo from '../views/maestro/Reactivo.vue'
import CreateReactivo from '../views/global/CreateReactivo.vue'

import Cuestionario from "../views/global/Cuestionario.vue"

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [		
        {
            path: '/maestro',
            name: 'index',
            component: Index
        },
        {
            path: '/maestro/reactivos/list',
            name: 'reactivo.list',
            component: Reactivo
        },
        {
            path: '/maestro/cuestionarios',
            name: 'cuestionarios',
            component: Cuestionario
        },
        {
            path: '/maestro/reactivos/create',
            name: 'reactivo.create',
            component: CreateReactivo
        },
        {
            path: "*",
            component: PageNotFound
        }
	],
});

export default router