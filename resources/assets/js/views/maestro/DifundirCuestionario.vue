<template>
  <div>
    <div v-if="errors.length" class="alert alert-danger error">
      <b>Please correct the following error(s):</b>
      <ul>
        <li v-for="e in errors">{{ e }}</li>
      </ul>
    </div>

    <h3 class="titles">{{ titulo }}</h3>

    <card-transition>
      <div class="card mb-5" :key="cuestionarioSelected.id" v-if="datos">
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Titulo</th>
                <th scope="col">{{cuestionarioSelected.nota}}</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <th>Instrucciones</th>
                <td>{{ cuestionarioSelected.instruccion }}</td>
              </tr>

              <tr>
                <th>Nivel</th>
                <td>{{ cuestionarioSelected.materia.materia }}</td>
              </tr>

              <tr>
                <th>Punto Gramatical</th>
                <td>{{ cuestionarioSelected.punto_gramatical }}</td>
              </tr>

              <tr>
                <th>Cuestionario para</th>
                <td>{{ cuestionarioSelected.tipo.catalogo }}</td>
              </tr>

              <tr>
                <th>Reactivos de reading</th>
                <td>{{ cuestionarioSelected.cantidad_reading }}</td>
              </tr>

              <tr>
                <th>Reactivos de writing</th>
                <td>{{ cuestionarioSelected.cantidad_writing }}</td>
              </tr>

              <tr>
                <th>Reactivos de listening</th>
                <td>{{ cuestionarioSelected.cantidad_listening }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </card-transition>

    <form class="mb-4" v-on:submit.prevent="checkForm">
      <div class="row justify-content-center inputs" v-if="datos">
        <div class="col-md-3 col-sm-12">
          <div class="card text-white bg-secondary">
            <div class="card-header">
              <h5>Alumnos</h5>

              <input type="radio" id="all" value="false" v-model="showListaAlumnos">
              <label for="all">Todos</label>
              <input type="radio" id="select" value="true" v-model="showListaAlumnos">
              <label for="select">Seleccionar</label>
            </div>
            <transition name="fade">
              <div class="card-body" v-if="showListaAlumnos=='true'">
                <div v-for="matricula in matriculas" v-bind:key="matricula.matricula">
                  <input
                    type="checkbox"
                    :id="matricula.matricula"
                    :value="matricula.matricula"
                    v-model="matriculasSeleccionadas"
                  >
                  <label :for="matricula.matricula">{{matricula.matricula}}</label>
                </div>
              </div>
            </transition>
            <div class="card-footer" v-if="showListaAlumnos=='true'">
              <span>Matriculas seleccionadas: {{ matriculasSeleccionadas }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 inputs">
          <input
            type="number"
            class="form-control"
            onkeypress="return event.charCode >= 48"
            min="1"
            v-model="aplicacion.duracion"
            placeholder="Duración del examen"
          >
        </div>
        <div class="col-md-3 col-sm-12 inputs">
          <input
            type="datetime-local"
            class="form-control"
            v-model="aplicacion.fecha_hora"
            placeholder="Fecha y hora de aplicacion"
          >
        </div>

        <div v-if="false">
          <date-pick
            v-model="date"
            class="form-control"
            :pickTime="true"
            :isDateDisabled="isPastDate"
            :format="'YYYY-MM-DD HH:mm'"
          ></date-pick>
        </div>

        <div class="col-md-2 col-sm-12 inputs">
          <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import DatePick from "vue-date-pick";
export default {
  components: { DatePick },
  props: ["cuestionarioSelected"],
  data() {
    return {
      cuestionario: [],
      aplicacion: [],
      errors: [],
      datos: false,
      titulo: "No hay datos",
      date: "2018-11-29 12:00",
      showListaAlumnos: "false",
      matriculas: [
        { matricula: "1" },
        { matricula: "143048" },
        { matricula: "143049" },
        { matricula: "153020" },
        { matricula: "143530" }
      ],
      matriculasSeleccionadas: []
    };
  },
  mounted() {
    console.log(this.cuestionarioSelected);
    if (this.cuestionarioSelected) {
      this.cuestionario = this.cuestionarioSelected;
      console.log(this.cuestionarioSelected);
      this.titulo = "Aplicar cuestionario";
      this.datos = true;
      axios
        .get("/api/puntos?id=" + this.cuestionarioSelected.punto_gramatical)
        .then(response => {
          this.cuestionarioSelected.punto_gramatical =
            response.data.data.puntos_gramaticales[0].punto_gramatical;
        })
        .catch(e => {
          console.log(e);
        });
    } else {
      this.$router.push({ name: "cuestionarios" });
    }
  },
  methods: {
    isPastDate(date) {
      const currentDate = new Date();
      return currentDate >= date;
    },
    add(matricula) {
      console.log(this.aplicacion.fecha_hora);
      const currentDate = new Date();
      //const yesterdayDate = new Date("Y/m/d", strtotime("-1 days"));
      //console.log(yesterdayDate);
      console.log(currentDate);

      let difusion = {
        evaluacion_id: this.cuestionarioSelected.id,
        profesor_id: "1",
        matricula: matricula,
        duracion: this.aplicacion.duracion,
        fecha_aplicacion: this.aplicacion.fecha_hora,
        status: "2"
      };

      axios
        .post("/api/difusiones", difusion)
        .then(response => {
          //this.clear();
          this.$router.push({ name: "cuestionarios" });
          this.$toastr(
            "success",
            "El cuestionario ha sido programado correctamente"
          );
        })
        .catch(e => {
          console.log("errorSQL: " + e);
        });
    },

    addDifusiones() {
      let axiosArray = [];
      if (this.showListaAlumnos == "false") {
        for (var i = 0; i < this.matriculas.length; i++) {
          let difusion = {
            evaluacion_id: this.cuestionarioSelected.id,
            profesor_id: "1",
            matricula: this.matriculas[i].matricula,
            duracion: this.aplicacion.duracion,
            fecha_aplicacion: this.aplicacion.fecha_hora,
            status: "2"
          };
          let newPromise = axios({
            method: "post",
            url: "/api/difusiones",
            data: difusion
          });
          axiosArray.push(newPromise);
        }
      } else {
        for (var i = 0; i < this.matriculasSeleccionadas.length; i++) {
          let difusion = {
            evaluacion_id: this.cuestionarioSelected.id,
            profesor_id: "1",
            matricula: this.matriculasSeleccionadas[i],
            duracion: this.aplicacion.duracion,
            fecha_aplicacion: this.aplicacion.fecha_hora,
            status: "2"
          };
          let newPromise = axios({
            method: "post",
            url: "/api/difusiones",
            data: difusion
          });
          axiosArray.push(newPromise);
        }
      }

      axios
        .all(axiosArray)
        .then(
          axios.spread((...responses) => {
            //responses.forEach(res => console.log("Success"));
            this.$router.push({ name: "cuestionarios" });
            this.$toastr(
              "success",
              "El cuestionario ha sido programado correctamente"
            );
          })
        )
        .catch(error => {
          console.log("errorSQL: " + error);
        });
    },

    checkForm() {
      if (
        this.aplicacion.duracion &&
        this.aplicacion.fecha_hora &&
        (this.showListaAlumnos == "false" ||
          this.matriculasSeleccionadas.length != 0)
      ) {
        this.addDifusiones();
      }

      this.errors = [];

      if (!this.aplicacion.duracion) this.errors.push("Duracion is required");
      if (!this.aplicacion.fecha_hora)
        this.errors.push("Fecha y hora is required");
      /*console.log(
        this.showListaAlumnos == "false" ||
          this.matriculasSeleccionadas.length != 0
      );/*/
      if (
        this.showListaAlumnos == "true" &&
        this.matriculasSeleccionadas.length == 0
      )
        this.errors.push("No hay alumnos seleccionados");
    }
  }
};
</script>
    
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.25s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>


