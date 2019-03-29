<template>
  <div>
    <br>
    <div class="form-row">
      <div class="col-md-10 col-sm-12">
        <h3>Actividades pendientes</h3>
      </div>
      <div class="col-md-2 col-sm-12"></div>
    </div>
    <hr>
    <div>
      <br>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div class="card mb-5" v-for="actividad in actividades" :key="actividad.difusion_id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  <h4>{{ actividad.difusion_id.evaluacion_id.nota }}</h4>
                  Tiempo: {{actividad.difusion_id.duracion}} minutos
                  <br>
                  Limite: {{calcularLimite(actividad.difusion_id.fecha_limite)}}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-primary"
                    v-on:click="aplicar(actividad)"
                    type="button"
                  >Aplicar</button>
                </div>
              </div>
            </div>
          </div>
        </card-transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      actividades: [],
      matricula: "1"
    };
  },
  created() {
    this.fetchActividades();
    console.log(this.actividades);
  },
  methods: {
    fetchActividades(
      page_url = "/api/alumnoDifusiones?getActiveByAlumno=actividades&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data.data.alumnoDifusiones);
          this.actividades = response.data.data.alumnoDifusiones;
          this.fetchEvaluaciones(this.actividades);
          //date_default_timezone_set("America/Mexico_City");

          /*this.actividades.maximo = strtotime(
            "+" + this.actividades.duracion + " minute",
            strtotime(this.actividades.fecha_aplicacion)
          );*/
        })
        .catch(e => {
          console.log(e);
        });
      console.log("Actividades");
      console.log(this.actividades);
    },
    fetchEvaluaciones(difusion) {
      console.log("evaluaciones " + difusion.length);
      for (var i = 0; i < difusion.length; i++) {
        console.log(difusion[i].difusion_id.evaluacion_id);
        console.log("I " + i);
        //let vm = this;
        console.log(difusion[i]);
        var evaluacion;
        evaluacion = this.getEvaluacion(
          i,
          difusion[i].difusion_id.evaluacion_id
        );
        console.log(evaluacion);
        difusion[i].difusion_id.evaluacion_id = evaluacion;
        console.log(difusion[i]);
      }
    },
    getEvaluacion(i, id) {
      var evaluacion;
      axios
        .get("/api/evaluaciones?byID=" + id)
        .then(response => {
          console.log("Cuestionario " + i);
          console.log(response.data.data.evaluaciones);

          return response.data.data.evaluaciones[0];
        })
        .catch(e => {
          console.log(e);
        });
    },
    calcularLimite(fecha) {
      var options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        hour12: true
      };
      var dt = new Date(fecha);
      return dt.toLocaleDateString("es-MX", options);
    },
    aplicar(cuestionarioSelected) {
      this.$router.push({
        name: "cuestionario.aplicar",
        params: { cuestionarioSelected }
      });
    }
  }
};
</script>

<style>
</style>