<template>
  <div>
    <br>
    <div class="form-row">
      <div class="col-md-10 col-sm-12">
        <h3>Examenes pendientes</h3>
      </div>
      <div class="col-md-2 col-sm-12"></div>
    </div>
    <hr>

    <div>
      <h4 style="text-align: center;">Ordinarios</h4>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div class="card mb-5" v-for="ordinario in ordinarios" :key="ordinario.difusion_id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  <h4>{{ ordinario.difusion_id.evaluacion_id.nota }}</h4>
                  Tiempo: {{ordinario.difusion_id.duracion}} minutos
                  <br>
                  Limite: {{formatoFecha(ordinario.difusion_id.fecha_limite)}}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-primary"
                    v-on:click="aplicar(ordinario)"
                    type="button"
                  >Aplicar</button>
                </div>
              </div>
            </div>
          </div>
        </card-transition>
      </div>
    </div>

    <div>
      <h4 style="text-align: center;">Recuperaciones</h4>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div
            class="card mb-5"
            v-for="recuperacion in recuperaciones"
            :key="recuperacion.difusion_id"
          >
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  <h4>{{ recuperacion.difusion_id.evaluacion_id.nota }}</h4>
                  Tiempo: {{recuperacion.difusion_id.duracion}} minutos
                  <br>
                  Limite: {{formatoFecha(recuperacion.difusion_id.fecha_limite)}}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-primary"
                    v-on:click="aplicar(recuperacion)"
                    type="button"
                  >Aplicar</button>
                </div>
              </div>
            </div>
          </div>
        </card-transition>
      </div>
    </div>

    <div>
      <h4 style="text-align: center;">Extraordinarios</h4>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div
            class="card mb-5"
            v-for="extraordinario in extraordinarios"
            :key="extraordinario.difusion_id"
          >
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  <h4>{{ extraordinario.difusion_id.evaluacion_id.nota }}</h4>
                  Tiempo: {{extraordinario.difusion_id.duracion}} minutos
                  <br>
                  Limite: {{formatoFecha(extraordinario.difusion_id.fecha_limite)}}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-primary"
                    v-on:click="aplicar(extraordinario)"
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
      matricula: "1",
      ordinarios: [],
      recuperaciones: [],
      extraordinarios: []
    };
  },
  created() {
    this.fetchOrdinarios();
    this.fetchRecuperaciones();
    this.fetchExtraordinarios();
  },
  methods: {
    fetchOrdinarios(
      page_url = "/api/alumnoDifusiones?getActiveByAlumno=ordinarios&matricula=" +
        this.matricula +
        "&duracion=10&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          var difusiones = response.data.data.alumnoDifusiones;

          for (var i = 0; i < difusiones.length; i++) {
            this.setEvaluacionesOrdinarios(i, difusiones);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    setEvaluacionesOrdinarios(i, difusiones) {
      axios
        .get(
          "/api/evaluaciones?byID=" + difusiones[i].difusion_id.evaluacion_id
        )
        .then(response => {
          //this.actividades[i].difusion_id.evaluacion_id =
          //response.data.data.evaluaciones[0];
          difusiones[i].difusion_id.evaluacion_id =
            response.data.data.evaluaciones[0];
          this.ordinarios = difusiones;
          // this.setEvaluacionActividad(difusiones);
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchRecuperaciones(
      page_url = "/api/alumnoDifusiones?getActiveByAlumno=recuperaciones&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          var difusiones = response.data.data.alumnoDifusiones;

          for (var i = 0; i < difusiones.length; i++) {
            this.setEvaluacionesRecuperaciones(i, difusiones);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    setEvaluacionesRecuperaciones(i, difusiones) {
      axios
        .get(
          "/api/evaluaciones?byID=" + difusiones[i].difusion_id.evaluacion_id
        )
        .then(response => {
          //this.actividades[i].difusion_id.evaluacion_id =
          //response.data.data.evaluaciones[0];
          difusiones[i].difusion_id.evaluacion_id =
            response.data.data.evaluaciones[0];
          this.recuperaciones = difusiones;
          // this.setEvaluacionActividad(difusiones);
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchExtraordinarios(
      page_url = "/api/alumnoDifusiones?getActiveByAlumno=extraordinarios&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          var difusiones = response.data.data.alumnoDifusiones;

          for (var i = 0; i < difusiones.length; i++) {
            this.setEvaluacionesExtraordinarios(i, difusiones);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },
    setEvaluacionesExtraordinarios(i, difusiones) {
      axios
        .get(
          "/api/evaluaciones?byID=" + difusiones[i].difusion_id.evaluacion_id
        )
        .then(response => {
          //this.actividades[i].difusion_id.evaluacion_id =
          //response.data.data.evaluaciones[0];
          difusiones[i].difusion_id.evaluacion_id =
            response.data.data.evaluaciones[0];
          this.extraordinarios = difusiones;
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
