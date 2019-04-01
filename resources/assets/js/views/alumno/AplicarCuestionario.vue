<template>
  <div>
    <h3 class="titles">{{ cuestionario.difusion_id.evaluacion_id.nota }}</h3>
    <hr>
    <h5>{{ cuestionario.difusion_id.evaluacion_id.instruccion }}</h5>
    <hr>

    <card-transition>
      <div
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
        v-for="reactivo in reading"
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
    </card-transition>

    <card-transition>
      <div
        class="card mb-5 col-md-10 col-sm-12"
        align="center"
        style="margin: auto;"
        v-for="reactivo in writing"
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

              <input type="text">
            </tbody>
          </table>
        </div>
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
      multimedia: "no",
      titulo: "No hay datos",
      editing: false
    };
  },

  mounted() {
    if (this.cuestionarioSelected) {
      this.editing = true;
      (this.titulo = "Editar cuestionario"),
        (this.cuestionario = this.cuestionarioSelected);
      this.cuestionario.id = this.cuestionarioSelected.id;
      console.log(this.cuestionario);
      this.getReading();
      this.getListening();
      this.getWriting();
    } else {
      this.$router.push({ name: "index" });
    }
  },

  created() {},

  methods: {
    getReading(
      page_url = "/api/reactivos?byCompetencia=reading&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          this.reading = response.data;
          console.log("READING");
          console.log(this.reading);
          console.log("END READING");
        })
        .catch(e => {
          console.log(e);
        });
    },

    getListening(
      page_url = "/api/reactivos?byCompetencia=listening&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          this.listening = response.data;
          console.log("LISTENING");
          console.log(this.listening);
          console.log("END LISTENING");
        })
        .catch(e => {
          console.log(e);
        });
    },

    getWriting(
      page_url = "/api/reactivos?byCompetencia=writing&tipo=" +
        this.cuestionario.difusion_id.evaluacion_id.tipo.id +
        "&punto=" +
        this.cuestionario.difusion_id.evaluacion_id.punto_gramatical.id
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          this.writing = response.data;
          console.log("WRITING");
          console.log(this.writing);
          console.log("END WRITING");
        })
        .catch(e => {
          console.log(e);
        });
    },
    newWindow: function(url) {
      window.open(url, "_blank");
    }
  }
};
</script>
