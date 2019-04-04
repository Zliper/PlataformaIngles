<template>
  <div>
    <h3 class="titles">{{ titulo }}</h3>

    <card-transition>
      <div class="card mb-5" :key="resultado.id" v-for="resultado in resultados">
        <div class="card-body">
          <h3>{{resultado.has_difusion.evaluacion.nota}}</h3>
          <h5>Matricula: {{resultado.matricula}}</h5>
          <h5>Reading: {{resultado.readingCorrectas}} de {{resultado.has_difusion.evaluacion.cantidad_reading}}</h5>
          <h5>Listening: {{resultado.listeningCorrectas}} de {{resultado.has_difusion.evaluacion.cantidad_listening}}</h5>
          <h5>Writing: {{resultado.writingCorrectas}} de {{resultado.has_difusion.evaluacion.cantidad_writing}}</h5>
        </div>
      </div>
    </card-transition>
  </div>
</template>

<script>
export default {
  props: ["difusion"],
  data() {
    return {
      titulo: "",
      datos: false,
      resultados: []
    };
  },
  mounted() {
    console.log("difusion recived");
    console.log(this.difusion);
    if (this.difusion) {
      //   this.cuestionario = this.cuestionarioSelected;
      //   console.log(this.cuestionarioSelected);
      this.titulo = "Resultados de la aplicación";
      this.datos = true;
      //   this.aplicacion.duracion = this.cuestionarioSelected.duracion;
      //this.aplicacion.fecha_hora = "12/02/2020 02:20 p.m.";
    } else {
      this.$router.push({ name: "difusiones" });
    }
  },
  created() {
    this.fetchResultados();
  },
  methods: {
    fetchResultados() {
      axios
        .get(
          "/api/alumnoDifusiones?resultadosByDifusion=" +
            this.difusion.difusion_id
        )
        .then(response => {
          console.log(
            "Matriculas seleccionadas de la difusion "
            // + this.cuestionarioSelected.difusion_id
          );
          console.log(response.data);
          //   console.log(this.matriculas);
          this.resultados = response.data;
          //this.extraordinarios = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>

<style scoped>
</style>