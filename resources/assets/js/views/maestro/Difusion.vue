<template>
  <div>
    <br>
    <div class="form-row">
      <div class="col-md-10 col-sm-12">
        <h3>Aplicaciones creadas</h3>
      </div>
    </div>
    <hr>
    <br>
    <div>
      <h4 style="text-align: center;">Actividades</h4>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div class="card mb-5" v-for="actividad in actividades" :key="actividad.difusion_id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  Cuestionario: {{ actividad.evaluacion_id.nota }}
                  <br>
                  <!-- Alumno: {{ actividad.matricula }} -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-danger"
                    v-on:click="confirmDelete(actividad)"
                    type="button"
                  >Borrar</button>
                  <button class="btn btn-info" v-on:click="editar(actividad)" type="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </card-transition>
      </div>
    </div>

    <div>
      <h4 style="text-align: center;">Ordinarios</h4>
      <div class="row justify-content-center inputs">
        <card-transition style="min-width: 75%">
          <div class="card mb-5" v-for="ordinario in ordinarios" :key="ordinario.difusion_id">
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 inputs">
                <div class="col-md-12 col-sm-12">
                  Cuestionario: {{ ordinario.evaluacion_id.nota }}
                  <br>
                  <!-- Alumno: {{ ordinario.matricula }} -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-danger"
                    v-on:click="confirmDelete(ordinario)"
                    type="button"
                  >Borrar</button>
                  <button class="btn btn-info" v-on:click="editar(ordinario)" type="button">Editar</button>
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
                  Cuestionario: {{ recuperacion.evaluacion_id.nota }}
                  <br>
                  <!-- Alumno: {{ recuperacion.matricula }} -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-danger"
                    v-on:click="confirmDelete(recuperacion)"
                    type="button"
                  >Borrar</button>
                  <button
                    class="btn btn-info"
                    v-on:click="editar(recuperacion)"
                    type="button"
                  >Editar</button>
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
                  Cuestionario: {{ extraordinario.evaluacion_id.nota }}
                  <br>
                  <!-- Alumno: {{ extraordinario.matricula }} -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12" align="right">
                <div class="col-md-12 col-sm-12 inputs">
                  <button
                    class="btn btn-danger"
                    v-on:click="confirmDelete(extraordinario)"
                    type="button"
                  >Borrar</button>
                  <button
                    class="btn btn-info"
                    v-on:click="editar(extraordinario)"
                    type="button"
                  >Editar</button>
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
      profesorID: "1",
      tipos: [],
      actividades: [],
      ordinarios: [],
      recuperaciones: [],
      extraordinarios: []
    };
  },
  created() {
    this.fetchTipos();
    this.fetchExtraordinarios();
    this.fetchRecuperaciones();
    this.fetchOrdinarios();
    this.fetchActividades();
  },
  methods: {
    fetchTipos(page_url = "/api/cuestionarios") {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response.data.data.catalogo);
          this.tipos = response.data.data.catalogo;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchExtraordinarios(
      page_url = "/api/difusiones?getActiveByProfesor=" +
        this.profesorID +
        "&tipo=extraordinarios&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(response);
          console.log("ext");
          this.extraordinarios = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchRecuperaciones(
      page_url = "/api/difusiones?getActiveByProfesor=" +
        this.profesorID +
        "&tipo=recuperaciones&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("rec");
          this.recuperaciones = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchOrdinarios(
      page_url = "/api/difusiones?getActiveByProfesor=" +
        this.profesorID +
        "&tipo=ordinarios&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("ord");
          this.ordinarios = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchActividades(
      page_url = "/api/difusiones?getActiveByProfesor=" +
        this.profesorID +
        "&tipo=actividades&status=2"
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("act");
          this.actividades = response.data.data.difusiones;
          console.log(this.actividades);
        })
        .catch(e => {
          console.log(e);
        });
    },
    editar(cuestionarioSelected) {
      this.$router.push({
        name: "difusion.edit",
        params: { cuestionarioSelected }
      });
    },
    confirmDelete(cuestionarioSelected) {
      if (
        confirm(
          "¿Seguro que desea borrar la difusion " +
            cuestionarioSelected.evaluacion_id.nota +
            "? \n Esto no borrara el cuestionario \n Esta accion no se puede deshacer"
        )
      ) {
        this.borrar(cuestionarioSelected);
      }
    },
    borrar(cuestionarioSelected) {
      //console.log("cuestionario: " + cuestionarioSelected.difusion_id);
      axios
        .delete("/api/difusiones/" + cuestionarioSelected.difusion_id)
        .then(response => {
          this.delDifusionesAnteriores(cuestionarioSelected);
        })
        .catch(e => {
          console.log(e);
        });
    },
    delDifusionesAnteriores(cuestionarioSelected) {
      axios
        .delete("/api/alumnoDifusiones/" + cuestionarioSelected.difusion_id)
        .then(response => {
          //this.$router.push({ name: 'cuestionarios'})
          this.fetchExtraordinarios();
          this.fetchRecuperaciones();
          this.fetchOrdinarios();
          this.fetchActividades();
          //this.$router.push({ name: 'cuestionarios'})
          this.$toastr("warning", "Difusion deleted successfully");
          console.log(response);
          // this.addDifusiones(); //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>
<style>
.mb-5 {
  min-width: 75%;
}
</style>
