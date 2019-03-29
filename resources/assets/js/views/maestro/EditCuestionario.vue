<template>
  <div>
    <div v-if="errors.length" class="alert alert-danger error">
      <b>Please correct the following error(s):</b>
      <ul>
        <li v-for="e in errors">{{ e }}</li>
      </ul>
    </div>

    <h3 class="titles">{{ titulo }}</h3>
    <hr>
    <div>
      <div class="row justify-content-center inputs" v-if="editing">
        <form class="mb-4" v-on:submit.prevent="checkForm">
          <input v-model="cuestionario.nota" class="form-control inputs" placeholder="Titulo">

          <select
            v-model="cuestionario.materia.id"
            id="materiaZ"
            hint="s"
            class="form-control inputs"
          >
            <option selected disabled value>Nivel</option>
            <option
              v-for="materia in materias"
              v-bind:key="materia.id"
              v-bind:value="materia.id"
            >{{ materia.materia }}</option>
          </select>

          <select v-model="cuestionario.tipo.id" id="tipo" hint="s" class="form-control inputs">
            <option selected disabled value>Tipo de examen</option>
            <option
              v-for="tipo in tipos"
              v-bind:key="tipo.id"
              v-bind:value="tipo.id"
            >{{ tipo.tipo }}</option>
          </select>

          <select
            v-model="cuestionario.punto_gramatical.id"
            id="punto"
            hint="s"
            class="form-control inputs"
          >
            <option selected disabled value>Punto gramatical</option>
            <option
              v-for="punto in puntos"
              v-bind:key="punto.id"
              v-bind:value="punto.id"
            >{{ punto.punto_gramatical }}</option>
          </select>

          <div class="row justify-content-center inputs">
            <div class="col-md-3 col-sm-12 inputs">
              <div class="card text-white bg-secondary">
                <div class="card-body">
                  <h3 class="card-title text-center">Reading</h3>
                  <input
                    type="number"
                    class="form-control"
                    onkeypress="return event.charCode >= 48"
                    min="1"
                    v-model="cuestionario.cantidad_reading"
                    placeholder="Cantidad"
                  >
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-12 inputs">
              <div class="card text-white bg-secondary">
                <div class="card-body">
                  <h3 class="card-title text-center">Listening</h3>
                  <input
                    type="number"
                    class="form-control"
                    onkeypress="return event.charCode >= 48"
                    min="1"
                    v-model="cuestionario.cantidad_listening"
                    placeholder="Cantidad"
                  >
                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-12 inputs">
              <div class="card text-white bg-secondary">
                <div class="card-body">
                  <h3 class="card-title text-center">Writing</h3>
                  <input
                    type="number"
                    class="form-control"
                    onkeypress="return event.charCode >= 48"
                    min="1"
                    v-model="cuestionario.cantidad_writing"
                    placeholder="Cantidad"
                  >
                </div>
              </div>
            </div>
          </div>

          <textarea
            v-model="cuestionario.instruccion"
            class="form-control inputs"
            placeholder="Instrucciones"
          ></textarea>
          <div class="row justify-content-center inputs">
            <div class="col-md-4 col-sm-12 inputs">
              <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["cuestionarioSelected"],
  data() {
    return {
      materias: [],
      tipos: [],
      puntos: [],
      errors: [],
      cuestionario: {},
      titulo: "No hay datos",
      editing: false
    };
  },

  mounted() {
    console.log(this.cuestionarioSelected);
    if (this.cuestionarioSelected) {
      this.editing = true;
      (this.titulo = "Editar cuestionario"),
        (this.cuestionario = this.cuestionarioSelected);
      this.cuestionario.id = this.cuestionarioSelected.id;
      console.log(this.cuestionario);
    } else {
      this.$router.push({ name: "cuestionarios" });
    }
  },

  created() {
    this.fetchMaterias();
    this.fetchTipos();
    this.fetchPuntos();
  },

  methods: {
    fetchMaterias(page_url = "/api/materias") {
      axios
        .get(page_url)
        .then(response => {
          this.materias = response.data.data.nivel;
        })
        .catch(e => {
          console.log(e);
        });
    },
    fetchTipos(page_url = "/api/cuestionarios") {
      axios
        .get(page_url)
        .then(response => {
          this.tipos = response.data.data.catalogo;
        })
        .catch(e => {
          console.log(e);
        });
    },

    puntosBy(materia) {
      this.fetchPuntos("/api/puntos?materia=" + materia);
      console.log("/api/puntos?materia=" + materia);
      console.log("materia= " + materia);
    },

    fetchPuntos(page_url = "/api/puntos") {
      console.log(page_url);
      axios
        .get(page_url)
        .then(response => {
          this.puntos = response.data.data.puntos_gramaticales;
          console.log(response);
        })
        .catch(e => {
          console.log("Error?: " + e);
        });
    },

    add() {
      this.cuestionario = {
        profesor_id: "1",
        materia_id: this.cuestionario.materia.id,
        catalogo_id: this.cuestionario.tipo.id,
        //"alumno_id": '1',
        punto_gramatical: this.cuestionario.punto_gramatical.id,
        cantidad_reading: this.cuestionario.cantidad_reading,
        cantidad_listening: this.cuestionario.cantidad_listening,
        cantidad_writing: this.cuestionario.cantidad_writing,
        nota: this.cuestionario.nota,
        instruccion: this.cuestionario.instruccion,
        status: "1"
      };

      axios
        .put(
          "/api/evaluaciones/" + this.cuestionarioSelected.id,
          this.cuestionario
        )
        .then(response => {
          this.clear();
          this.$router.push({ name: "cuestionarios" });
          this.$toastr("success", "Cuestionario updated successfully");
          console.log(response);
        })
        .catch(e => {
          console.log(this.cuestionario.punto_gramatical);
          console.log(e);
        });
    },

    update() {},

    delete() {},

    clear() {
      //this.cuestionario.tipo = '';
      //this.cuestionari.materia = '';
      this.cuestionario.punto_gramatical = "";
      this.cuestionario.cantidad_reading = "";
      this.cuestionario.cantidad_listening = "";
      this.cuestionario.cantidad_writing = "";
      this.cuestionario.nota = "";
      this.cuestionario.instruccion = "";
    },

    checkForm() {
      if (
        /*this.cuestionario.tipo.id && this.cuestionario.materia.id &&*/

        this.cuestionario.punto_gramatical &&
        this.cuestionario.cantidad_reading &&
        this.cuestionario.cantidad_listening &&
        this.cuestionario.cantidad_writing &&
        this.cuestionario.nota &&
        this.cuestionario.instruccion
      ) {
        this.add();
      }

      this.errors = [];

      //if (!this.cuestionario.materia.id) this.errors.push('Materia is required');
      //if (!this.cuestionario.tipo.id) this.errors.push('Tipo is required');
      if (!this.cuestionario.punto_gramatical)
        this.errors.push("Punto gramatical is required");
      if (!this.cuestionario.cantidad_reading)
        this.errors.push("Cantidad de reactivos reading is required");
      if (!this.cuestionario.cantidad_listening)
        this.errors.push("Cantidad de reactivos listening is required");
      if (!this.cuestionario.cantidad_writing)
        this.errors.push("Cantidad de reactivos writing is required");
      if (!this.cuestionario.nota) this.errors.push("Titulo is required");
      if (!this.cuestionario.instruccion)
        this.errors.push("Instrucciones is required");
    }
  }
};
</script>