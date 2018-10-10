<template>
	<div>
		<div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="titles">Opciones</h3>
		<hr>
		<div>
			<div class="row justify-content-center inputs">
				<div class="col-md-8 col-sm-12">
					<label for="catalogo">Destino del reactivo</label>
					<select v-model="reactivo.tipo_cuestionario" id="catalogo" class="form-control">
						<option v-for="c in cuestionarios" v-bind:value="c.id"> {{ c.tipo }}</option>
					</select>
				</div>
			</div>

			<div class="row justify-content-center inputs">
				<div class="col-md-8 col-sm-12">
					<label for="materia">Punto Gramatical</label>
					<select v-model="reactivo.punto_gramatical" name="materia" id="materia" class="form-control">
						<option v-for="punto in puntos" v-bind:value="punto.id"> {{ punto.unidad }} - {{ punto.punto_gramatica }}</option>
					</select>
				</div>
			</div>
			
			<div class="row justify-content-center inputs">
				<div class="col-md-8 col-sm-12">
					<h6>Elije la competencia al cual seran asignados los reactivos y el numero de ellos</h6>
				</div>
			</div>
			
			<div class="row justify-content-center inputs">
				<div class="col-md-3 col-sm-12 inputs">
					<select v-model="reactivo.competencia" name="competencia" id="competencia" class="form-control">
							<option selected disabled value="">Competencia</option>
							<option v-for="competencia in competencias" v-bind:value="competencia.id"> {{ competencia.competencia }}</option>
					</select>
				</div>
				<div class="col-md-3 col-sm-12 inputs">
					<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1"  :disabled="disable" v-model="reactivo.cantidad" placeholder="Cantidad de reactivos">
				</div>

				<div class="col-md-2 col-sm-12 inputs">
					<button class="btn btn-primary" v-on:click="disableButtons" type="button">Confirmar</button>
				</div>
			</div>
	
			<div class="row justify-content-center">
				<div style="width: 50%; margin: 0 auto;" class="col-md-8 inputs">
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
						<strong>Hola!</strong><br>De ser necesario adjunte un archivo de apoyo para que el alumno pueda responder el reactivo.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class=" inputs" align="center">
            <div class="upload">
              <ul v-if="files.length">
                <li v-for="(file, index) in files" :key="file.id">
                  <span>{{file.name}}</span> -
                  <span>{{file.size}}</span> -
                  <span v-if="file.error">{{file.error}}</span>
                  <span v-else-if="file.success">success</span>
                  <span v-else-if="file.active">active</span>
                  <span v-else-if="file.active">active</span>
                  <span v-else></span>
                </li>
              </ul>
              <ul v-else>
                <td>
                  <div class="text-center">
                    <h4>Arrastre el archivo a subir<br/>o</h4>
                    <label for="file" class="btn btn-lg btn-primary">Seleccione el archivo</label>
                  </div>
                </td>
              </ul>

              <div v-show="$refs.upload && $refs.upload.dropActive" class="drop-active">
    		        <h3>Suelte el archivo para subir</h3>
              </div>
              <div class="example-btn">
                <file-upload
                  class="btn btn-primary"
                  accept="image/png,image/jpeg,image/jpg,audio/mp3,application/pdf"
                  post-action="/upload/post"
                  :multiple="false"
                  :drop="true"
                  :drop-directory="false"
                  v-model="files"
                  ref="upload">
                    <i class="fa fa-plus"></i>
                    Seleccionar archivo
                </file-upload>
                <button type="button" class="btn btn-success" v-if="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true">
                  <i class="fa fa-arrow-up" aria-hidden="true"></i>
                  Iniciar la carga
                </button>
                <button type="button" class="btn btn-danger"  v-else @click.prevent="$refs.upload.active = false">
                  <i class="fa fa-stop" aria-hidden="true"></i>
                  Detener la carga
                </button>
              </div>
            </div>
          </div>
				</div>

				<div class="col-md-8 inputs">
					<label for="materia">Tipo de reactivo</label>
					<select v-model="reactivo.tipo_reactivo" @change="instruccionesBy(reactivo.tipo_reactivo)"  name="materia" id="materia" class="form-control mb-4">
						<option v-for="t in tipos" v-bind:value="t.id"> {{ t.tipo }}</option>
					</select>
				</div>

				<div class="col-md-8 inputs">
					<label for="instruccion">Instrucciones</label>
					<select name="instruccion" v-model="instruccion" class="form-control mb-4">
						<option  v-for="instruccion in instrucciones" v-bind:value="  instruccion.id "> {{ instruccion.instruccion }} </option>
					</select>
				</div>
			</div>
			
			<h3 class="titles">Reactivos</h3>

			<template v-if="disable">
				<div class="row justify-content-center">
					<div v-for="x in reactivos" class="card col-sm-10 col-md-7 border-dark inputs">
						<div class="card-body">
							<div class="form-group">
								<label for="question">Pregunta</label>
								<input type="text" v-model="preguntas[x].pregunta" class="form-control" placeholder="Pregunta">
							</div>
							<div class="form-group">
								<label for="respuesta">Respuesta correcta</label>
								<input type="text" v-model="preguntas[x].respuesta" class="form-control" placeholder="Respuesta correcta">
							</div>
                            <template v-if="reactivo.tipo_reactivo == 2">
								<div class="form-group">
										<label for="respuesta">Respuesta incorrecta</label>
										<input type="text" v-model="preguntas[x].opciones.op_1" class="form-control" placeholder="Respuesta incorrecta">
									</div>
							</template>
							<template v-if="reactivo.tipo_reactivo == 3">
								<div class="row form-group">
									<div class="col-sm-4">
										<label for="respuesta">Opción 1</label>
										<input type="text" v-model="preguntas[x].opciones.op_1" class="form-control" placeholder="Opción 1">
									</div>
									<div class="col-sm-4">
										<label for="respuesta">Opción 2</label>
										<input type="text" v-model="preguntas[x].opciones.op_2" class="form-control" placeholder="Opción 1">
									</div>
									<div class="col-sm-4">
										<label for="respuesta">Opción 3</label>
										<input type="text" v-model="preguntas[x].opciones.op_3" class="form-control" placeholder="Opción 1">
									</div>
								</div>
							</template>
						</div>
					</div>
					<div class="col-sm-7">
						<button class="btn btn-primary btn-lg btn-block" @click="checkForm">Guardar</button>	
					</div>
				</div>
			</template>
			<hr>
		</div>
	</div>
</template>

<script>
import FileUpload from "vue-upload-component";
var cantidad;
export default {
  components: {
    FileUpload
  },
  data() {
    return {
      disable: false,
      cuestionarios: [],
      instrucciones: [],
      instruccion: "",
      tipos: [],
      reactivos: [],
      errors: [],
      puntos: [],
      competencias: [],
      reactivo: {
        cantidad: 1
      },
      preguntas: [],
      files: [],
      textID: '',
    };
  },

  created() {
    this.fetchCatalogo();
    this.fetchPuntosGramaticales();
    this.fetchTipoReactivos();
    this.fetchCompetencias();
  },

  methods: {
    fetchCatalogo() {
      axios
        .get("/api/cuestionarios")
        .then(response => {
          this.cuestionarios = response.data.data.catalogo;
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchPuntosGramaticales(
      page_url = "/api/puntos?year=" + new Date().getFullYear().toString()
    ) {
      axios
        .get(page_url)
        .then(response => {
          this.puntos = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchTipoReactivos() {
      axios
        .get("/api/tipos")
        .then(response => {
          this.tipos = response.data.data.tipos;
        })
        .catch(e => {
          console.log(e);
        });
    },

    instruccionesBy(id) {
      this.fetchInstrucciones("/api/instrucciones?by=" + id);
      console.log(id);
    },

    fetchInstrucciones(page_url = "/api/instrucciones") {
      axios
        .get(page_url)
        .then(response => {
          this.instrucciones = response.data.data.instrucciones;
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchCompetencias(page_url = "/api/competencias") {
      axios
        .get(page_url)
        .then(response => {
          this.competencias = response.data.data.competencias;
        })
        .catch(e => {
          console.log(e);
        });
    },

    range(start, edge, step) {
      if (arguments.length == 1) {
        edge = start;
        start = 0;
      }

      edge = edge || 0;
      step = step || 1;

      for (var ret = []; (edge - start) * step > 0; start += step) {
        ret.push(start);
      }
      return ret;
    },

    checkForm() {
      if (
        this.reactivo.tipo_reactivo &&
        this.reactivo.punto_gramatical &&
        this.reactivo.competencia
      ) {
        this.addText(); //primero se agrega el texto o url
      }

      this.errors = [];

      if (!this.reactivo.tipo_reactivo)
        this.errors.push("Tipo Reactivo es requerido");
      if (!this.reactivo.punto_gramatical)
        this.errors.push("Punto gramatical es requerido");
      console.log(this.reactivo.competencia);
      if (!this.reactivo.competencia)
        this.errors.push("Competencia es requerido");
    },

    add() {
      for (var i = 0; i < cantidad; i++) {
        this.addReactivo(this.preguntas[i]);
      }
    },

    addText() {
      console.clear;
      console.log(this.files[0]);
      axios
        .post("/api/texts", {
          text: this.files[0].file
        })
        .then(response => {
          this.textID = response.data.id;
          this.add(); //luego se registran las preguntas
        })
        .catch(e => {
          console.log(e);
        });
    },

    addReactivo(pregunta) {
      axios
        .post("/api/reactivos", {
          competencia_id: this.reactivo.competencia,
          tipo_id: this.reactivo.tipo_reactivo,
          estatus_id: 2,
          profesor_id: 1,
          text_id: this.textID,
          punto_id: this.reactivo.punto_gramatical,
          catalogo_id: this.reactivo.tipo_cuestionario,
          pregunta: pregunta.pregunta,
          respuesta_correcta: pregunta.respuesta,
          opciones: pregunta.opciones
        })

        .then(response => {
          this.$router.push({ name: "reactivo.list" });
          this.$toastr("success", "Reactivos added successfully");
        })
        .catch(e => {
          console.log(e);
        });
    },

    disableButtons() {
      this.errors = [];
      cantidad = this.reactivo.cantidad;
      console.log(!this.reactivo.competencia);
      if (!this.reactivo.competencia)
        this.errors.push("Error elegir una competencia");
      else{
      if (cantidad > 0) {
        this.disable = true;
        this.reactivos = this.range(cantidad);
        this.preguntas = this.range(cantidad);

        for (var i = 0; i < cantidad; i++) {
          this.preguntas[i] = {
            opciones: {}
          };
        }
        return;
      } else {
        this.errors.push("Error elegir una cantidad de reactivos");
      }
      }
    }
  }
};
</script>

</<style>
  ul {
    padding: 0;
  }
  .upload {
    border-radius: 10px;
    border: 2px dashed;
    padding: 15px;
    border-color: #007bff;
}
</style>
