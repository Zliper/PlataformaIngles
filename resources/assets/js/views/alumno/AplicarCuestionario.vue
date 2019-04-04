<template>
  <div v-bind:key="cuestionario.id">
    <h3 class="titles">{{ cuestionario.difusion_id.evaluacion_id.nota }}</h3>
    <hr>
    <h5 v-if="!end">{{ cuestionario.difusion_id.evaluacion_id.instruccion }}</h5>
    <hr v-if="!end">

    <card-transition v-if="!update">
      <div
        v-bind:key="reactivo.id"
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
      >
        <div class="card-head">
          <div class="container">
            <br>
            <div class="row" v-if="!end">
              <!-- <div class="col-md-4"></div> -->
              <div class="col-13 col-sm-6 col-md-9">
                <!-- <p class="text-left">{{ reactivo.pregunta }}</p> -->
                <h5 class="text-left">{{ reactivo.pregunta }}</h5>
              </div>
              <div class="col-5 col-md-3">
                <button
                  class="btn btn-secondary btn-block"
                  @click="newWindow('/storage/' + reactivo.text.text)"
                >Archivo multimedia</button>
              </div>
            </div>
            <div class="row justify-content-md-center" v-else>
              <div class="col">
                <h2
                  v-if="cuestionario.difusion_id.evaluacion_id.tipo.id == 4"
                  class="text-center"
                >Actividad terminada.</h2>
                <h2 v-else class="text-center">Examen terminado.</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <br>
          <div v-if="!end">
            <div v-if="reactivo.tipo_id == 1">
              <textarea
                type="text"
                v-model="respuesta"
                class="form-control"
                placeholder="Respuesta"
              ></textarea>
            </div>
            <div v-else class="container">
              <div class="row justify-content-md-center">
                <div class="col col-lg-3" v-bind:key="key" v-for="(value, key) in this.respuestas">
                  <button
                    class="btn btn-block"
                    v-bind:class="value.class"
                    @click="setActive(value)"
                    v-bind:key="value.id"
                  >{{ value.opcion }}</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <br>
          <button class="btn btn-success" v-on:click="save()" type="button" v-if="!end">Next</button>
          <button class="btn btn-primary" v-on:click="exit()" type="button" v-else>Finish</button>
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
      respuestas: [],
      competencia: "",
      activeButton: "btn-info",
      inactiveButton: "btn-outline-info",
      editing: false,
      end: false,
      update: false
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
    randomizeRespuestas() {
      this.respuestas.push({
        id: 0,
        opcion: this.reactivo.respuesta_correcta,
        class: this.inactiveButton
      });
      for (var i = this.reactivo.opciones.length - 1; i >= 0; i--) {
        this.respuestas.push({
          id: i + 1,
          opcion: this.reactivo.opciones[i].opcion,
          class: this.inactiveButton
        });
      }
      console.log("array opciones");
      console.log(this.respuestas);
      for (var i = this.respuestas.length - 1; i >= 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = this.respuestas[i];
        this.respuestas[i] = this.respuestas[j];
        this.respuestas[j] = temp;
      }
      console.log("array opciones randomized");
      console.log(this.respuestas);
    },
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
            this.randomizeRespuestas();
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
            this.randomizeRespuestas();
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
            this.randomizeRespuestas();
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
        this.finish();
      }
    },
    setActive(value) {
      this.respuesta = value.opcion;
      for (var i = this.respuestas.length - 1; i >= 0; i--) {
        if (this.respuestas[i].id == value.id) {
          this.respuestas[i].class = this.activeButton;
        } else {
          this.respuestas[i].class = this.inactiveButton;
        }
      }
      console.log(this.respuesta);
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
          this.clear();
          this.next(this.cuestionario);
          //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },
    clear() {
      this.respuesta = "";
      this.respuestas = [];
    },
    next(cuestionarioSelected) {
      this.getReading();
      this.$router.push({
        name: "cuestionario.aplicar",
        params: { cuestionarioSelected }
      });
      this.cuestionario = this.cuestionario;
    },
    finish() {
      axios
        .put("/api/alumnoDifusiones/" + this.cuestionario.id, {
          status: 4
        })
        .then(response => {
          this.clear();
          this.cuestionario.status = 4;

          //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
      this.update = true;
      this.end = true;
      this.update = false;
    },
    exit() {
      this.$router.push({
        name: "index"
      });
    },
    newWindow: function(url) {
      window.open(url, "_blank");
    }
  }
};
</script>
