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
          <div class="card mb-5" v-for="actividad in actividades" :key="actividad.id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">{{ actividad.nota }}</div>
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
  },
  methods: {
    fetchActividades(
      page_url = "/api/difusiones?getActiveByAlumno=actividades&matricula=" +
        this.matricula +
        "&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data);
          this.actividades = response.data;
        })
        .catch(e => {
          console.log(e);
        });
      console.log(this.actividades);
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