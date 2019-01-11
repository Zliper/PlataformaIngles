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
          <div class="card mb-5" v-for="ordinario in ordinarios" :key="ordinario.id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">{{ ordinario.nota }}</div>
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
          <div class="card mb-5" v-for="recuperacion in recuperaciones" :key="recuperacion.id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">{{ recuperacion.nota }}</div>
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
          <div class="card mb-5" v-for="extraordinario in extraordinarios" :key="extraordinario.id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">{{ extraordinario.nota }}</div>
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
      page_url = "/api/difusiones?getActiveByAlumno=ordinarios&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data);
          this.ordinarios = response.data;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.ordinarios);
    },

    fetchRecuperaciones(
      page_url = "/api/difusiones?getActiveByAlumno=recuperaciones&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data);
          this.recuperaciones = response.data;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.recuperaciones);
    },

    fetchExtraordinarios(
      page_url = "/api/difusiones?getActiveByAlumno=extraordinarios&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data);
          this.extraordinarios = response.data;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.extraordinarios);
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
