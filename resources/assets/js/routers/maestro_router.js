import Vue from "vue";
import VueRouter from "vue-router";

import PageNotFound from "../views/errors/404.vue";

import Index from "../views/maestro/Index.vue";
import Reactivo from "../views/maestro/Reactivo.vue";
import Cuestionario from "../views/global/Cuestionario.vue";
import Difusion from "../views/maestro/Difusion.vue";
import CreateReactivo from "../views/global/CreateReactivo.vue";
import CreateCuestionario from "../views/maestro/CreateCuestionario.vue";
import DifundirCuestionario from "../views/maestro/DifundirCuestionario.vue";
import EditCuestionario from "../views/maestro/EditCuestionario.vue";
import EditDifusion from "../views/maestro/EditDifusion.vue";
import Resultados from "../views/maestro/Resultados.vue";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/maestro",
      name: "index",
      component: Index
    },
    {
      path: "/maestro/reactivos/list",
      name: "reactivo.list",
      component: Reactivo
    },
    {
      path: "/maestro/cuestionarios",
      name: "cuestionarios",
      component: Cuestionario
    },
    {
      path: "/maestro/cuestionarios/create",
      name: "cuestionario.create",
      component: CreateCuestionario
    },
    {
      path: "/maestro/cuestionarios/edit",
      name: "cuestionario.edit",
      component: EditCuestionario,
      props: true
    },
    {
      path: "/maestro/cuestionarios/difundir",
      name: "cuestionario.difundir",
      component: DifundirCuestionario,
      props: true
    },
    {
      path: "/maestro/difusiones",
      name: "difusiones",
      component: Difusion
    },
    {
      path: "/maestro/difusiones/edit",
      name: "difusion.edit",
      component: EditDifusion,
      props: true
    },
    {
      path: "/maestro/difusiones/resultados",
      name: "difusiones.resultados",
      component: Resultados,
      props: true
    },
    {
      path: "/maestro/reactivos/create",
      name: "reactivo.create",
      component: CreateReactivo
    },
    {
      path: "*",
      component: PageNotFound
    }
  ]
});

export default router;
