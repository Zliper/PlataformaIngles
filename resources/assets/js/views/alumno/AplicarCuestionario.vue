<template>
  <div>
    <h3 class="titles">{{ cuestionario.difusion_id.evaluacion_id.nota }}</h3>
    <hr>
    <h5>{{ cuestionario.difusion_id.evaluacion_id.instruccion }}</h5>
    <hr>

    <!-- <card-transition>
      <div
        v-bind:key="reactivo.id"
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
      >
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">{{ reactivo.pregunta }}</th>
                <th scope="col">
                  <button
                    class="btn btn-secondary"
                    @click="newWindow('/storage/' + reactivo.text.text)"
                  >Archivo multimedia</button>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="table-success">
                <th>Opcion 1</th>
                <td>{{ reactivo.respuesta_correcta }}</td>
              </tr>
              <tr v-bind:key="key" v-for="(value, key) in reactivo.opciones">
                <th>Opción {{ key+2 }}</th>
                <td>{{ value.opcion }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </card-transition>

    <card-transition>
      <div
        v-bind:key="reactivo.id"
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
        v-for="reactivo in listening"
        :key="reactivo.id"
      >
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">{{ reactivo.pregunta }}</th>
                <th scope="col">
                  <button
                    class="btn btn-secondary"
                    @click="newWindow('/storage/' + reactivo.text.text)"
                  >Archivo multimedia</button>
                </th>
              </tr>
            </thead>

            <tbody>
              <tr class="table-success">
                <th>Opcion 1</th>
                <td>{{ reactivo.respuesta_correcta }}</td>
              </tr>

              <tr v-bind:key="key" v-for="(value, key, index) in reactivo.opciones">
                <th>Opción {{ key+2 }}</th>
                <td>{{ value.opcion }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </card-transition>-->

    <card-transition>
      <div
        v-bind:key="reactivo.id"
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
      >
        <div class="card-head">
          <table class="table table-hover">
            <thead class="thead">
              <tr>
                <th scope="col">{{ reactivo.pregunta }}</th>
                <th scope="col">
                  <button
                    class="btn btn-secondary"
                    @click="newWindow('/storage/' + reactivo.text.text)"
                  >Archivo multimedia</button>
                </th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="card-body">
          <div v-if="reactivo.tipo_id == 1">
            <textarea type="text" v-model="respuesta" class="form-control" placeholder="Respuesta"></textarea>
          </div>
          <div v-else>
            <button
              class="btn btn-secondary"
              @click="respuesta = reactivo.respuesta_correcta"
            >{{ reactivo.respuesta_correcta }}</button>
            <button
              class="btn btn-secondary"
              @click="respuesta = value.opcion"
              v-bind:key="key"
              v-for="(value, key) in reactivo.opciones"
            >{{ value.opcion }}</button>
          </div>
          <br>
          <button class="btn btn-success" v-on:click="save()" type="button">Next</button>
        </div>
        <!-- <div class="card-footer">
          <button class="btn btn-primary" v-on:click="aplicar()" type="button">Next</button>
        </div>-->
      </div>
    </card-transition>
  </div>
</template>

<script>
export default {
  props: ["cuestionarioSelected"],

  data() {
    return {
      cuestionario: {},
      reading: [],
      listening: {},
      writing: {},
      reactivo: {},
      multimedia: "no",
      titulo: "No hay datos",
      respuesta: "",
      competencia: "",
      editing: false
    };
  },

  mounted() {
    if (this.cuestionarioSelected) {
      console.log("cuestionario recibed");
      console.log(this.cuestionarioSelected);
      this.editing = true;
      (this.titulo = "Editar cuestionario"),
        (this.cuestionario = this.cuestionarioSelected);
      this.cuestionario.id = this.cuestionarioSelected.id;
      console.log("cuestionario setted");
      console.log(this.cuestionario);
      this.getReading();
    } else {
      this.$router.push({ name: "index" });
    }
  },

  created() {},

  methods: {
    getReading(
      page_url = "/api/reactivos?byCompetenciaRandom=reading&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      if (
        this.cuestionario.readingGuardadas <
        this.cuestionario.difusion_id.evaluacion_id.cantidad_reading
      ) {
        console.log("obtener reading");
        console.log(
          "hay " +
            this.cuestionario.readingGuardadas +
            " reading guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_reading
        );
        let vm = this;

        axios
          .get(page_url)
          .then(response => {
            this.reactivo = response.data;
            console.log("READING");
            console.log(this.reactivo);
            this.competencia = "reading";
            console.log("END READING");
          })
          .catch(e => {
            console.log(e);
          });
      } else {
        console.log("reading completas, obtener listening");
        console.log(
          "hay " +
            this.cuestionario.readingGuardadas +
            " reading guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_reading
        );
        this.getListening();
      }
    },

    getListening(
      page_url = "/api/reactivos?byCompetenciaRandom=listening&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      if (
        this.cuestionario.listeningGuardadas <
        this.cuestionario.difusion_id.evaluacion_id.cantidad_listening
      ) {
        console.log("obtener listening");
        console.log(
          "hay " +
            this.cuestionario.listeningGuardadas +
            " listening guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_listening
        );
        let vm = this;

        axios
          .get(page_url)
          .then(response => {
            this.reactivo = response.data;
            console.log("LISTENING");
            console.log(this.reactivo);
            this.competencia = "listening";
            console.log("END LISTENING");
          })
          .catch(e => {
            console.log(e);
          });
      } else {
        console.log("listening completas, obtener writing");
        console.log(
          "hay " +
            this.cuestionario.listeningGuardadas +
            " listening guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_listening
        );
        this.getWriting();
      }
    },

    getWriting(
      page_url = "/api/reactivos?byCompetenciaRandom=writing&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      if (
        this.cuestionario.writingGuardadas <
        this.cuestionario.difusion_id.evaluacion_id.cantidad_writing
      ) {
        console.log("obtener writing");
        console.log(
          "hay " +
            this.cuestionario.writingGuardadas +
            " writing guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_writing
        );
        let vm = this;

        axios
          .get(page_url)
          .then(response => {
            this.reactivo = response.data;
            console.log("WRITING");
            console.log(this.reactivo);
            this.competencia = "writing";
            console.log("END WRITING");
          })
          .catch(e => {
            console.log(e);
          });
      } else {
        console.log("writing completas, competencias completadas");
        console.log(
          "hay " +
            this.cuestionario.writingGuardadas +
            " writing guardadas de " +
            this.cuestionario.difusion_id.evaluacion_id.cantidad_writing
        );
        // this.getWriting();
      }
    },
    save() {
      console.log(this.respuesta);
      console.log(this.competencia);
      console.log(this.reactivo);
      console.log(this.cuestionario);
      var guardadas;
      var correctas;
      if (this.competencia == "reading") {
        this.cuestionario.readingGuardadas =
          this.cuestionario.readingGuardadas + 1;
        if (this.respuesta == this.reactivo.respuesta_correcta) {
          this.cuestionario.readingCorrectas =
            this.cuestionario.readingCorrectas + 1;
        }
      } else if (this.competencia == "listening") {
        this.cuestionario.listeningGuardadas =
          this.cuestionario.listeningGuardadas + 1;
        if (this.respuesta == this.reactivo.respuesta_correcta) {
          this.cuestionario.listeningCorrectas =
            this.cuestionario.listeningCorrectas + 1;
        }
      } else if (this.competencia == "writing") {
        this.cuestionario.writingGuardadas =
          this.cuestionario.writingGuardadas + 1;
        if (this.respuesta == this.reactivo.respuesta_correcta) {
          this.cuestionario.writingCorrectas =
            this.cuestionario.writingCorrectas + 1;
        }
      }
      console.log("nuevo cuestionario");
      console.log(this.cuestionario);
      axios
        .put("/api/alumnoDifusiones/" + this.cuestionario.id, {
          readingGuardadas: this.cuestionario.readingGuardadas,
          listeningGuardadas: this.cuestionario.listeningGuardadas,
          writingGuardadas: this.cuestionario.writingGuardadas,
          readingCorrectas: this.cuestionario.readingCorrectas,
          listeningCorrectas: this.cuestionario.listeningCorrectas,
          writingCorrectas: this.cuestionario.writingCorrectas,
          status: this.cuestionario.status
        })
        .then(response => {
          this.next(this.cuestionario);
          //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },
    next(cuestionarioSelected) {
      this.$router.push({
        name: "cuestionario.aplicar",
        params: { cuestionarioSelected }
      });
      this.cuestionario = this.cuestionario;
    },
    newWindow: function(url) {
      window.open(url, "_blank");
    }
  }
};
</script>
