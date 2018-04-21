<template>
	<div>
		<div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="titles">Reactivos</h3>
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
					<div class="card text-white bg-secondary">
						<div class="card-header">
							<label class="form-check-label">
								<input type="radio" name="competencia" id="eading" v-model="reactivo.competencia" v-bind:value="1"> Reading
							</label>
						</div>
						<div class="card-body">
							<h5 class="card-title text-center">Reading</h5>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-6 col-sm-12 inputs">
									<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1"  :disabled="disable" v-model="reactivo.cantidad" placeholder="# Reactivos">
								</div>
								<div class="col-md-3 col-sm-12 inputs">
									<button class="btn btn-primary" v-on:click="disableButtons" type="button">Confirmar</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-12 inputs">
					<div class="card text-white bg-secondary">
						<div class="card-header">
							<label class="form-check-label">
								<input type="radio" name="competencia" id="eading" v-model="reactivo.competencia" v-bind:value="1"> Reading
							</label>
						</div>
						<div class="card-body">
							<h5 class="card-title text-center">Reading</h5>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-6 col-sm-12 inputs">
									<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1"  :disabled="disable" v-model="reactivo.cantidad" placeholder="# Reactivos">
								</div>
								<div class="col-md-3 col-sm-12 inputs">
									<button class="btn btn-primary" v-on:click="disableButtons" type="button">Confirmar</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-12 inputs">
					<div class="card text-white bg-secondary">
						<div class="card-header">
							<label class="form-check-label">
								<input type="radio" name="competencia" id="grammar" v-model="reactivo.competencia" v-bind:value="3"> Writting
							</label>
						</div>
						<div class="card-body">
							<h5 class="card-title text-center">Reading</h5>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-6 col-sm-12 inputs">
									<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" :disabled="disable" v-model="reactivo.cantidad" placeholder="# Reactivos">
								</div>
								<div class="col-md-3 col-sm-12 inputs">
									<button class="btn btn-primary" v-on:click="disableButtons" type="button">Confirmar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<div class="row justify-content-center">
				<div class="col-sm-8 inputs">
					<div class="alert alert-primary alert-dismissible fade show" role="alert">
						<strong>Hola!</strong><br>De ser necesario asigna un archivo de apoyo para que el alumno pueda responder el reactivo.
						Asignado una URL en el cuadro de texto de abajo.
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<h6>URL</h6>
					<div class="input-group inputs">
						<input type="text" v-model="reactivo.url" class="form-control" placeholder="Ingresa el enlace del archivo">
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
			
			<h3>Reactivos</h3>

			<template v-if="disable">
				<div class="row justify-content-center">
					<div v-for="x in reactivos" class="card col-sm-7 col-md-8 border-dark inputs">
						<div class="card-body">
							<div class="form-group">
								<label for="question">Pregunta</label>
								<input type="text" v-model="preguntas[x].pregunta" class="form-control" placeholder="Pregunta">
							</div>
							<div class="form-group">
								<label for="respuesta">Respuesta correcta</label>
								<input type="text" v-model="preguntas[x].respuesta" class="form-control" placeholder="Respuesta correcta">
							</div>
							<template v-if="reactivo.tipo_reactivo != 2">
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
							<template v-else>
								<div class="row form-group">
									<div class="col-sm-12 text-center">
										<label for="respuesta">Opción 1</label>
										<input type="text" v-model="preguntas[x].opciones.op_1" class="form-control" placeholder="Opción 1">
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

export default {
	data() {
		return {
			disable: false,
			cuestionarios: [],
			instrucciones: [],
			instruccion: '',
			tipos: [],
			reactivos: [],
			errors: [],
			puntos: [],
			reactivo: {
				cantidad:0,
			},
			preguntas: [],
		}
	},

	created() {
		this.fetchCatalogo();
		this.fetchPuntosGramaticales();
		this.fetchTipoReactivos();
	},

	methods: {
		fetchCatalogo() {
			axios.get('/api/cuestionarios')
			.then(response => {
				this.cuestionarios = response.data.data.catalogo;
			})
			.catch(e=>{
				console.log(e);
			});
		},

		fetchPuntosGramaticales(page_url='/api/puntos?year=' + new Date().getFullYear().toString()) {
			axios.get(page_url)
			.then(response => {
				this.puntos = response.data;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchTipoReactivos() {
			axios.get('/api/tipos')
			.then(response => {
				this.tipos = response.data.data.tipos;
			})
			.catch(e => {
				console.log(e);
			});
		},

		instruccionesBy(id) {
			this.fetchInstrucciones('/api/instrucciones?by=' + id);
			console.log(id);
		},

		fetchInstrucciones(page_url='/api/instrucciones') {
			axios.get(page_url)
			.then(response=>{
				this.instrucciones = response.data.data.instrucciones;
			})
			.catch(e=>{
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
			if (this.reactivo.tipo_reactivo 
				&& this.reactivo.punto_gramatical
				&& this.reactivo.competencia
				&& this.reactivo.url) 
			{
				this.addText(); //primero se agrega el texto o url 
			}

		this.errors = [];

		if (!this.reactivo.tipo_reactivo) this.errors.push("Tipo Reactivo es requerido"); 
		if (!this.reactivo.punto_gramatical ) this.errors.push("Punto gramatical es requerido"); 
		if (!this.reactivo.competencia) this.errors.push("Competencia es requerido"); 
		if (!this.reactivo.url) this.errors.push("Url de apoyo es requerido");
	},

	add() {
		for (var i = 0; i < this.reactivo.cantidad; i++) {
			this.addReactivo(this.preguntas[i]);
		}
	},

	addText() {
		axios.post('/api/texts', {
			"text" : this.reactivo.url
		})
		.then(response => {
			this.reactivo.url = response.data.id;
			this.add(); //luego se registran las preguntas
		})
		.catch(e => {
			console.log(e);
		});
	},

	addReactivo(pregunta) {
		
		axios.post('/api/reactivos',
		{
			"competencia_id" : this.reactivo.competencia,
			"tipo_id": this.reactivo.tipo_reactivo,
			"estatus_id": 2,
			"profesor_id": 1,
			"text_id": this.reactivo.url,
			"punto_id": this.reactivo.punto_gramatical,
			"catalogo_id":this.reactivo.tipo_cuestionario,
			"pregunta": pregunta.pregunta,
			"respuesta_correcta": pregunta.respuesta,
			"opciones" : pregunta.opciones
		})
		.then(response=>{
			this.$toastr('success', 'Reactivos added successfully');
		})
		.catch(e=>{
			console.log(e);
		});
	},

	disableButtons() {
		this.errors = [];

		if (this.reactivo.cantidad > 0) {

			this.disable = true;
			this.reactivos = this.range(this.reactivo.cantidad);
			this.preguntas = this.range(this.reactivo.cantidad);

			for (var i = 0; i < this.reactivo.cantidad; i++) {
				this.preguntas[i] = {
					opciones: {}
				};
			}
			return;
		}

		this.errors.push("Error elegir una cantidad de reactivos");
	}
}
}
</script>