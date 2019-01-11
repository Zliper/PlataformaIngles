<template>
  <div>
    <h3 class="titles">{{ cuestionario.nota }}</h3>
    <hr>
    <h5>{{ cuestionario.instruccion }}</h5>
    <hr>
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
      this.obtainReading();
      this.obtainListening();
      this.obtainWriting();
    } else {
      this.$router.push({ name: "index" });
    }
  },

  created() {},

  methods: {
    obtainReading(
      page_url = "/api/reactivos?byCompetencia=reading&tipo=" +
        this.cuestionario.catalogo_id +
        "&punto=" +
        this.cuestionario.punto_gramatical
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

    obtainListening(
      page_url = "/api/reactivos?byCompetencia=listening&tipo=" +
        this.cuestionario.catalogo_id +
        "&punto=" +
        this.cuestionario.punto_gramatical
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

    obtainWriting(
      page_url = "/api/reactivos?byCompetencia=writing&tipo=" +
        this.cuestionario.catalogo_id +
        "&punto=" +
        this.cuestionario.punto_gramatical
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
    }
  }
};
</script>
