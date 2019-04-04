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
      <card-transition style="min-width: 75%" v-if="renderComponent">
        <div class="card mb-5" v-for="tiempo in tiempos" :key="tiempo.id">
          <br>
          <div class="form-row">
            <div class="col-md-1 col-sm-1"></div>
            <div class="col-md-8 col-sm-10">
              <h3>{{tiempo.tiempo}}</h3>
            </div>
            <div class="col-md-2 col-sm-12">
              <button
                v-on:click="forceRerender(tiempo.id)"
                class="btn btn-secondary btn-block"
                v-if="!tiempo.expand"
              >Mostrar</button>
              <button
                v-on:click="forceRerender(tiempo.id)"
                class="btn btn-secondary btn-block"
                v-else
              >Ocultar</button>
            </div>
            <div class="col-md-1 col-sm-1"></div>
          </div>
          <hr>
          <div v-if="tiempo.expand">
            <br>
            <template v-if="tiempo.id == 0">
              <div>
                <h4 style="text-align: center;">Actividades</h4>
                <div class="row justify-content-center inputs">
                  <card-transition style="min-width: 75%">
                    <div
                      class="card mb-5"
                      v-for="actividad in actividadesPasadas"
                      :key="actividad.difusion_id"
                    >
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
                              v-on:click="confirmDelete(actividad,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Borrar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                    <div
                      class="card mb-5"
                      v-for="ordinario in ordinariosPasados"
                      :key="ordinario.difusion_id"
                    >
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
                              v-on:click="confirmDelete(ordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="recuperacion in recuperacionesPasadas"
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
                              v-on:click="confirmDelete(recuperacion,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="extraordinario in extraordinariosPasados"
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
                              v-on:click="confirmDelete(extraordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </card-transition>
                </div>
              </div>
            </template>

            <template v-if="tiempo.id == 1">
              <div>
                <h4 style="text-align: center;">Actividades</h4>
                <div class="row justify-content-center inputs">
                  <card-transition style="min-width: 75%">
                    <div
                      class="card mb-5"
                      v-for="actividad in actividadesActivas"
                      :key="actividad.difusion_id"
                    >
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
                              v-on:click="confirmDelete(actividad,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Borrar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                    <div
                      class="card mb-5"
                      v-for="ordinario in ordinariosActivos"
                      :key="ordinario.difusion_id"
                    >
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
                              v-on:click="confirmDelete(ordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="recuperacion in recuperacionesActivas"
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
                              v-on:click="confirmDelete(recuperacion,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="extraordinario in extraordinariosActivos"
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
                              v-on:click="confirmDelete(extraordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </card-transition>
                </div>
              </div>
            </template>

            <template v-if="tiempo.id == 2">
              <div>
                <h4 style="text-align: center;">Actividades</h4>
                <div class="row justify-content-center inputs">
                  <card-transition style="min-width: 75%">
                    <div
                      class="card mb-5"
                      v-for="actividad in actividadesProximas"
                      :key="actividad.difusion_id"
                    >
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
                              v-on:click="confirmDelete(actividad,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Borrar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(actividad,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                    <div
                      class="card mb-5"
                      v-for="ordinario in ordinariosProximos"
                      :key="ordinario.difusion_id"
                    >
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
                              v-on:click="confirmDelete(ordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(ordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="recuperacion in recuperacionesProximas"
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
                              v-on:click="confirmDelete(recuperacion,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(recuperacion,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
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
                      v-for="extraordinario in extraordinariosProximos"
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
                              v-on:click="confirmDelete(extraordinario,tiempo.id)"
                              type="button"
                              v-if="!tiempo.id == 0"
                            >Cancelar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="editar(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 2"
                            >Editar</button>
                            <button
                              class="btn btn-info"
                              v-on:click="resultados(extraordinario,tiempo.id)"
                              type="button"
                              v-if="tiempo.id == 0"
                            >Ver resultados</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </card-transition>
                </div>
              </div>
            </template>
          </div>
          <br>
        </div>
      </card-transition>
    </div>
  </div>
</template>



<script>
export default {
  data() {
    return {
      profesorID: "1",
      tipos: [],
      actividadesPasadas: [],
      ordinariosPasados: [],
      recuperacionesPasadas: [],
      extraordinariosPasados: [],
      actividadesActivas: [],
      ordinariosActivos: [],
      recuperacionesActivas: [],
      extraordinariosActivos: [],
      actividadesProximas: [],
      ordinariosProximos: [],
      recuperacionesProximas: [],
      extraordinariosProximos: [],
      renderComponent: true,
      tiempos: [
        {
          id: 0,
          tiempo: "Pasados",
          expand: false
        },
        {
          id: 1,
          tiempo: "Activos",
          expand: true
        },
        {
          id: 2,
          tiempo: "Por aplicar",
          expand: false
        }
      ]
    };
  },
  created() {
    this.fetchTipos();
    this.fetchActividades();
    this.fetchOrdinarios();
    this.fetchRecuperaciones();
    this.fetchExtraordinarios();
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
    fetchExtraordinarios() {
      let vm = this;

      axios
        .get(
          "/api/difusiones?getPastByProfesor=" +
            this.profesorID +
            "&tipo=extraordinarios&status=2"
        )
        .then(response => {
          console.log(response);
          console.log("ext");
          this.extraordinariosPasados = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getActiveByProfesor=" +
            this.profesorID +
            "&tipo=extraordinarios&status=2"
        )
        .then(response => {
          console.log(response);
          console.log("ext");
          this.extraordinariosActivos = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getNextByProfesor=" +
            this.profesorID +
            "&tipo=extraordinarios&status=2"
        )
        .then(response => {
          console.log(response);
          console.log("ext");
          this.extraordinariosProximos = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchRecuperaciones() {
      let vm = this;

      axios
        .get(
          "/api/difusiones?getPastByProfesor=" +
            this.profesorID +
            "&tipo=recuperaciones&status=2"
        )
        .then(response => {
          console.log("rec");
          this.recuperacionesPasadas = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getActiveByProfesor=" +
            this.profesorID +
            "&tipo=recuperaciones&status=2"
        )
        .then(response => {
          console.log("rec");
          this.recuperacionesActivas = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getNextByProfesor=" +
            this.profesorID +
            "&tipo=recuperaciones&status=2"
        )
        .then(response => {
          console.log("rec");
          this.recuperacionesProximas = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchOrdinarios() {
      let vm = this;

      axios
        .get(
          "/api/difusiones?getPastByProfesor=" +
            this.profesorID +
            "&tipo=ordinarios&status=2"
        )
        .then(response => {
          console.log("ord");
          this.ordinariosPasados = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getActiveByProfesor=" +
            this.profesorID +
            "&tipo=ordinarios&status=2"
        )
        .then(response => {
          console.log("ord");
          this.ordinariosActivos = response.data.data.difusiones;
          console.log(this.ordinariosActivos);
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getNextByProfesor=" +
            this.profesorID +
            "&tipo=ordinarios&status=2"
        )
        .then(response => {
          console.log("ord");
          this.ordinariosProximos = response.data.data.difusiones;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchActividades() {
      let vm = this;

      axios
        .get(
          "/api/difusiones?getPastByProfesor=" +
            this.profesorID +
            "&tipo=actividades&status=2"
        )
        .then(response => {
          console.log("act");
          this.actividadesPasadas = response.data.data.difusiones;
          console.log(this.actividadesPasadas);
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getActiveByProfesor=" +
            this.profesorID +
            "&tipo=actividades&status=2"
        )
        .then(response => {
          console.log("act");
          this.actividadesActivas = response.data.data.difusiones;
          console.log(this.actividadesActivas);
        })
        .catch(e => {
          console.log(e);
        });
      axios
        .get(
          "/api/difusiones?getNextByProfesor=" +
            this.profesorID +
            "&tipo=actividades&status=2"
        )
        .then(response => {
          console.log("act");
          this.actividadesProximas = response.data.data.difusiones;
          console.log(this.actividadesProximas);
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
          this.fetchActividades();
          this.fetchOrdinarios();
          this.fetchRecuperaciones();
          this.fetchExtraordinarios();
          //this.$router.push({ name: 'cuestionarios'})
          this.$toastr("warning", "Difusion deleted successfully");
          console.log(response);
          // this.addDifusiones(); //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },
    resultados(difusion) {
      //console.log(difusion);
      this.$router.push({
        name: "difusiones.resultados",
        params: { difusion }
      });
    },
    forceRerender(id) {
      if (this.tiempos[id].expand == true) {
        this.tiempos[id].expand = false;
      } else {
        this.tiempos[id].expand = true;
      }
      // Remove my-component from the DOM
      this.renderComponent = false;

      this.$nextTick(() => {
        // Add the component back in
        this.renderComponent = true;
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
