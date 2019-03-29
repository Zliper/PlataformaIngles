<template>
  <div>
    <div v-if="errors.length" class="alert alert-danger error">
      <b>Please correct the following error(s):</b>
      <ul>
        <li v-for="e in errors" v-bind:key="e in errors">{{ e }}</li>
      </ul>
    </div>

    <h3 class="titles">{{ titulo }}</h3>

    <card-transition>
      <div class="card mb-5" :key="cuestionarioSelected.difusion_id" v-if="datos">
        <div class="card-body">
          <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Titulo</th>
                <th scope="col">{{cuestionarioSelected.evaluacion_id.nota}}</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <th>Instrucciones</th>
                <td>{{ cuestionarioSelected.evaluacion_id.instruccion }}</td>
              </tr>

              <tr>
                <th>Reactivos de reading</th>
                <td>{{ cuestionarioSelected.evaluacion_id.cantidad_reading }}</td>
              </tr>

              <tr>
                <th>Reactivos de writing</th>
                <td>{{ cuestionarioSelected.evaluacion_id.cantidad_writing }}</td>
              </tr>

              <tr>
                <th>Reactivos de listening</th>
                <td>{{ cuestionarioSelected.evaluacion_id.cantidad_listening }}</td>
              </tr>

              <tr>
                <th>Duracion</th>
                <td>{{ cuestionarioSelected.duracion }} minutos</td>
              </tr>

              <tr>
                <th>Hora y fecha de aplicacion</th>
                <td>{{ formatoFecha(cuestionarioSelected.fecha_aplicacion) }}</td>
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
      showListaAlumnos: "true",
      difusionID: "",
      matriculas: [
        { matricula: 1 },
        { matricula: 143048 },
        { matricula: 143049 },
        { matricula: 153020 },
        { matricula: 143530 }
      ],
      matriculasSeleccionadas: [],
      matriculasOriginales: []
    };
  },
  mounted() {
    console.log(this.cuestionarioSelected);
    if (this.cuestionarioSelected) {
      this.cuestionario = this.cuestionarioSelected;
      console.log(this.cuestionarioSelected);
      this.titulo = "Editar aplicación";
      this.datos = true;
      this.aplicacion.duracion = this.cuestionarioSelected.duracion;
      //this.aplicacion.fecha_hora = "12/02/2020 02:20 p.m.";
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
      this.$router.push({ name: "difusiones" });
    }
  },
  created() {
    this.fetchMatriculas();
  },
  methods: {
    fetchMatriculas(
      page_url = "/api/alumnoDifusiones?matriculaByDifusion=" +
        this.cuestionarioSelected.difusion_id
    ) {
      let vm = this;

      axios
        .get(page_url)
        .then(response => {
          console.log(
            "Matriculas seleccionadas de la difusion " +
              this.cuestionarioSelected.difusion_id
          );
          console.log(response.data);
          console.log(this.matriculas);
          this.matriculasSeleccionadas = response.data;
          this.matriculasOriginales = response.data;
          //this.extraordinarios = response.data.data.evaluaciones;
        })
        .catch(e => {
          console.log(e);
        });
    },

    isPastDate(date) {
      const currentDate = new Date();
      return currentDate >= date;
    },

    addDifusion() {
      axios
        .put("/api/difusiones/" + this.cuestionarioSelected.difusion_id, {
          evaluacion_id: this.cuestionarioSelected.id,
          profesor_id: "1",
          duracion: this.aplicacion.duracion,
          fecha_aplicacion: this.aplicacion.fecha_hora,
          fecha_limite: this.calcularLimite(
            this.aplicacion.fecha_hora,
            this.aplicacion.duracion
          ),
          status: "2"
        })
        .then(response => {
          this.difusionID = this.cuestionarioSelected.difusion_id;
          console.log("ID DIFUSION");
          console.log(this.difusionID);
          console.log("ID DIFUSION");
          this.delDifusionesAnteriores(); //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },

    delDifusionesAnteriores() {
      axios
        .delete(
          "/api/alumnoDifusiones/" + this.cuestionarioSelected.difusion_id
        )
        .then(response => {
          //this.$router.push({ name: 'cuestionarios'})
          //this.$toastr("warning", "Difusiones deleted successfully");
          this.addDifusiones(); //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },

    addDifusiones() {
      let axiosArray = [];
      if (this.showListaAlumnos == "false") {
        for (var i = 0; i < this.matriculas.length; i++) {
          let difusion = {
            matricula: this.matriculas[i].matricula,
            difusion_id: this.difusionID,
            guardadas: "0",
            status: "2"
          };
          let newPromise = axios({
            method: "post",
            url: "/api/alumnoDifusiones",
            data: difusion
          });
          axiosArray.push(newPromise);
        }
      } else {
        for (var i = 0; i < this.matriculasSeleccionadas.length; i++) {
          let difusion = {
            matricula: this.matriculasSeleccionadas[i],
            difusion_id: this.difusionID,
            guardadas: "0",
            status: "2"
          };
          let newPromise = axios({
            method: "post",
            url: "/api/alumnoDifusiones",
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
            this.$router.push({ name: "difusiones" });
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

    formatoFecha(fecha) {
      var dt = new Date(fecha);

      const options = {
        year: "numeric",
        month: "2-digit",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        hour12: "true",
        timeZone: "America/Mexico_City",
        timeZoneName: "short"
      };

      return dt.toLocaleString("es-MX", options);
    },

    calcularLimite(fecha, duracion) {
      var dt = new Date(fecha);
      // dt.setMinutes(dt.getMinutes() + duracion);
      dt.setTime(dt.getTime() + duracion * 60 * 1000);

      var year = dt.getFullYear();
      var month = dt.getMonth() + 1;
      var day = dt.getDate();

      var hour = dt.getHours();
      var minute = dt.getMinutes();
      var second = dt.getSeconds();

      if (day < 10) {
        day = "0" + day;
      }
      if (month < 10) {
        month = "0" + month;
      }
      if (hour < 10) {
        hour = "0" + hour;
      }
      if (minute < 10) {
        minute = "0" + minute;
      }
      if (second < 10) {
        second = "0" + second;
      }

      var limite =
        year +
        "-" +
        month +
        "-" +
        day +
        " " +
        hour +
        ":" +
        minute +
        ":" +
        second;

      return limite;
    },

    checkForm() {
      if (
        this.aplicacion.duracion &&
        this.aplicacion.fecha_hora &&
        (this.showListaAlumnos == "false" ||
          this.matriculasSeleccionadas.length != 0)
      ) {
        // this.addDifusiones();
        this.addDifusion();
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