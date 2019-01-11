import Vue from "vue";
import VueRouter from "vue-router";

import PageNotFound from "../views/errors/404.vue";

import Index from "../views/alumno/Index.vue";
import Actividades from "../views/alumno/Actividades.vue";
import Examenes from "../views/alumno/Examenes.vue";
import AplicarCuestionario from "../views/alumno/AplicarCuestionario.vue";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/alumno",
      name: "index",
      component: Index
    },
    {
      path: "/alumno/actividades",
      name: "actividades",
      component: Actividades
    },
    {
      path: "/alumno/examenes",
      name: "examenes",
      component: Examenes
    },
    {
      path: "/alumno/cuestionario/aplicar",
      name: "cuestionario.aplicar",
      component: AplicarCuestionario,
      props: true
    },
    {
      path: "*",
      component: PageNotFound
    }
  ]
});

export default router;
