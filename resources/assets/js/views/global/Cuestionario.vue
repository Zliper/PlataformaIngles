<template>
  <div>
    <br>
    <div class="form-row">
      <div class="col-md-10 col-sm-12">
        <h3>Cuestionarios</h3>
      </div>
      <div class="col-md-2 col-sm-12">
        <router-link :to="{ name: 'cuestionario.create' }" >
          <button type="submit" class="btn btn-primary btn-block">Crear cuestionario</button>
        </router-link>
      </div>
    </div>
    <hr>
    <div>
      <div class="row justify-content-center inputs">
        <card-transition>
          <div class="card mb-5" v-for="tipo in tipos" :key="tipo.id" >
            <div class="card-header">
              <h2>{{ tipo.tipo }}</h2>
            </div>
            <div class="card-body">
              <template v-if="tipo.id == 1">
                <div class="card mb-5" v-for="extraordinario in extraordinarios" :key="extraordinario.id" >
                  <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 inputs">
                      <div class="col-md-12 col-sm-12">
                        {{ extraordinario.nota }}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right">
                      <div class="col-md-6 col-sm-12 inputs">
                        <button class="btn btn-primary" v-on:click="difundir(extraordinario)" type="button">Aplicar</button>
                        <button class="btn btn-danger" v-on:click="confirmDelete(extraordinario.id)" type="button">Borrar</button>
                        <button class="btn btn-info" v-on:click="editar(extraordinario)" type="button">Editar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
                     
              <template v-if="tipo.id == 2">
                <div class="card mb-5" v-for="recuperacion in recuperaciones" :key="recuperacion.id" >
                  <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 inputs">
                      <div class="col-md-12 col-sm-12">
                        {{ recuperacion.nota }}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right">
                      <div class="col-md-6 col-sm-12 inputs">
                        <button class="btn btn-primary" v-on:click="difundir(recuperacion)" type="button">Aplicar</button>
                        <button class="btn btn-danger" v-on:click="confirmDelete(recuperacion)" type="button">Borrar</button>
                        <button class="btn btn-info" v-on:click="editar(recuperacion)" type="button">Editar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
                        
              <template v-if="tipo.id == 3">
                <div class="card mb-5" v-for="ordinario in ordinarios" :key="ordinario.id" >
                  <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 inputs">
                      <div class="col-md-12 col-sm-12">
                        {{ ordinario.nota }}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right">
                      <div class="col-md-6 col-sm-12 inputs">
                        <button class="btn btn-primary" v-on:click="difundir(ordinario)" type="button">Aplicar</button>
                        <button class="btn btn-danger" v-on:click="confirmDelete(ordinario)" type="button">Borrar</button>
                        <button class="btn btn-info" v-on:click="editar(ordinario)" type="button">Editar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
                      
              <template v-if="tipo.id == 4">
                <div class="card mb-5" v-for="actividad in actividades" :key="actividad.id" >
                  <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 inputs">
                      <div class="col-md-12 col-sm-12">
                        {{ actividad.nota }}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12" align="right">
                      <div class="col-md-6 col-sm-12 inputs">
                        <button class="btn btn-primary" v-on:click="difundir(actividad)" type="button">Aplicar</button>
                        <button class="btn btn-danger" v-on:click="confirmDelete(actividad)" type="button">Borrar</button>
                        <button class="btn btn-info" v-on:click="editar(actividad)" type="button">Editar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </template>   
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
      page_url = "/api/evaluaciones?byTipo=1&profesorId=" + this.profesorID
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("ext");
          this.extraordinarios = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchRecuperaciones(
      page_url = "/api/evaluaciones?byTipo=2&profesorId=" + this.profesorID
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("ext");
          this.recuperaciones = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchOrdinarios(
      page_url = "/api/evaluaciones?byTipo=3&profesorId=" + this.profesorID
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("ext");
          this.ordinarios = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchActividades(
      page_url = "/api/evaluaciones?byTipo=4&profesorId=" + this.profesorID
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log("ext");
          this.actividades = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    difundir(cuestionarioSelected) {
      this.$router.push({
        name: "cuestionario.difundir",
        params: { cuestionarioSelected }
      });
    },
    editar(cuestionarioSelected) {
      this.$router.push({
        name: "cuestionario.edit",
        params: { cuestionarioSelected }
      });
    },
    confirmDelete(cuestionarioSelected) {
      if (
        confirm(
          "¿Seguro que desea borrar el cuestionario " +
            cuestionarioSelected.nota +
            "?"
        )
      ) {
        this.borrar(cuestionarioSelected);
      }
    },
    borrar(cuestionarioSelected) {
      axios
        .delete("/api/evaluaciones/" + cuestionarioSelected.id)
        .then(response => {
          this.fetchExtraordinarios();
          this.fetchRecuperaciones();
          this.fetchOrdinarios();
          this.fetchActividades();
          //this.$router.push({ name: 'cuestionarios'})
          this.$toastr("warning", "Cuestionario deleted successfully");
          console.log(response);
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>