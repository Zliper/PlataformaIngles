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
                  Limite: {{formatoFecha(actividad.difusion_id.fecha_limite)}}
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
      actividades2: [],
      matricula: "1"
    };
  },
  mounted() {
    this.fetchActividades();
  },
  created() {
    //this.fetchActividades();
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
          var difusiones = response.data.data.alumnoDifusiones;

          for (var i = 0; i < difusiones.length; i++) {
            this.setEvaluacionesActividades(i, difusiones);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    setEvaluacionesActividades(i, difusiones) {
      axios
        .get(
          "/api/evaluaciones?byID=" + difusiones[i].difusion_id.evaluacion_id
        )
        .then(response => {
          //this.actividades[i].difusion_id.evaluacion_id =
          //response.data.data.evaluaciones[0];
          difusiones[i].difusion_id.evaluacion_id =
            response.data.data.evaluaciones[0];
          this.actividades = difusiones;
          // this.setEvaluacionActividad(difusiones);
        })
        .catch(e => {
          console.log(e);
        });
    },
    formatoFecha(fecha) {
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