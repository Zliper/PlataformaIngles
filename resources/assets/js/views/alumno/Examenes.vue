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
                  <h4>{{ ordinario.nota }}</h4>
                  Tiempo: {{ordinario.duracion}} minutos
                  <br>
                  Limite: {{calcularLimite(ordinario.fecha_aplicacion,ordinario.duracion)}}
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
                  <h4>{{ recuperacion.nota }}</h4>
                  Tiempo: {{recuperacion.duracion}} minutos
                  <br>
                  Limite: {{calcularLimite(recuperacion.fecha_aplicacion,recuperacion.duracion)}}
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
                  <h4>{{ extraordinario.nota }}</h4>
                  Tiempo: {{extraordinario.duracion}} minutos
                  <br>
                  Limite: {{calcularLimite(extraordinario.fecha_aplicacion,extraordinario.duracion)}}
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
          console.log(response.data.data.alumnoDifusiones);
          this.ordinarios = response.data.data.alumnoDifusiones;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.ordinarios);
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
          console.log(response.data.data.alumnoDifusiones);
          this.recuperaciones = response.data.data.alumnoDifusiones;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.recuperaciones);
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
          console.log(response.data.data.alumnoDifusiones);
          this.extraordinarios = response.data.data.alumnoDifusiones;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.extraordinarios);
    },
    calcularLimite(fecha, duracion) {
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
      dt.setMinutes(dt.getMinutes() + duracion);
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
