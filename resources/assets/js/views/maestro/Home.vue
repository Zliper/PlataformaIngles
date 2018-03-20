<template>
	<div>

		<div v-if="errors.length" class="alert alert-danger mt-2">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="text-center mt-3 mb-3">Reactivos </h3>

		<div class="card">
			<div class="card-body">
				<div class="container">
					<form @submit.prevent="checkForm">
						<div class="form-row">
							<div class="col-auto">
								<label for="tipo">Tipo Pregunta</label>
								<select v-on:change="questioChanges" v-model="reactivo.tipo" class="form-control">
									<option v-for="t in tipos" v-bind:value="t.id"> {{ t.tipo }} </option>
								</select>
							</div>

							<div class="col-auto">
								<label for="competencia">Competencias</label>
								<select v-model="reactivo.competencia" class="form-control">
									<option v-for="c in competencias" v-bind:value="c.id"> {{ c.competencia }} </option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="text">Texto/Url</label>
							<textarea v-model="reactivo.text" class="form-control" rows="1" placeholder="Opcional"></textarea>
						</div>

						<div class="form-group">
							<label for="question">Pregunta</label>
							<input v-model="reactivo.pregunta" type="text" id="question" class="form-control" placeholder="Pregunta">
						</div>
						
						<template v-if="reactivo.tipo != 2">
							<div class="form-row justify-content-center">
								<div class="form-group col-sm-2 mr-1">
									<label for="ask_1">Opción 1</label>
									<input v-model="reactivo.opciones.ans_k1" type="text" class="form-control" placeholder="Opción 1">
								</div>
								<div class="form-group col-sm-2 mr-1">
									<label for="ask_1">Opción 2</label>
									<input v-model="reactivo.opciones.ans_k2" type="text" class="form-control" placeholder="Opción 2">
								</div>
								<div class="form-group col-sm-2 mr-1">
									<label for="ask_1">Opción 3</label>
									<input v-model="reactivo.opciones.ans_k3" type="text" class="form-control" placeholder="Opción 3">
								</div>
								<div class="form-group col-sm-2 mr-1">
									<label for="ask_1">Opción 4</label>
									<input v-model="reactivo.opciones.ans_k4" type="text" class="form-control" placeholder="Opción 4">
								</div>
							</div>
						</template>

						<template v-else>
							<div class="form-row justify-content-center">
								<div class="form-group col-sm-3">
									<label for="ask_1">Opción 1</label>
									<input v-model="reactivo.opciones.ans_k1"  type="text" class="form-control" placeholder="Opción 1">
								</div>

								<div class="form-group col-sm-3">
									<label for="ask_1">Opción 2</label>
									<input v-model="reactivo.opciones.ans_k2"  type="text" class="form-control" placeholder="Opción 2">
								</div>
							</div>
						</template>

						<div class="form-group">
							<label for="competencia">Respuesta Correcta</label>
							<select v-model="reactivo.respuesta" class="form-control">
								<option v-for="k in reactivo.opciones" v-bind:value="k"> {{ k }} </option>
							</select>
						</div>

						<button type="submit" class="btn btn-primary btn-block">Agregar</button>
					</form>	
				</div>
			</div>
		</div>
	</div>
</template>


<script>

import axios from 'axios';

export default {
	data() {
		return {
			data:{
				email: "root@gmail.com",
				password: "loremroot"
			},
			token: '',
			tipos: [],
			errors: [],
			competencias: [],
			pagination: {},
			reactivo: {
				opciones:{
					ans_k1: true,
					ans_k2: false
				},
			},
		}
	},

	created() {	
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			this.fetchTipos();
			this.fetchCompetencias();
		})
		.catch(e => {
			console.log(e);
		});
	},

	methods:{
		fetchTipos() {
			axios.get('/api/tipos', { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				this.tipos = response.data.data.tipos;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchCompetencias() {
			axios.get('/api/competencias', { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				this.competencias = response.data.data.competencias;
			})
			.catch(e=> {
				console.log(e);
			});
		},

		questioChanges() {
			this.reactivo.opciones = {};
		},

		checkForm() {
			if (this.reactivo.tipo &&
				this.reactivo.competencia &&
				this.reactivo.pregunta &&
				this.reactivo.respuesta) {
				
				this.addReactivo();
		}

		this.errors = [];

		if (!this.reactivo.tipo) this.errors.push("Tipo pregunta required");
		if (!this.reactivo.competencia) this.errors.push("Tipo competencia required");
		if (!this.reactivo.pregunta) this.errors.push("pregunta required");
		if (!this.reactivo.respuesta) this.errors.push("Respuesta required");
	},

	addReactivo() {
		this.deleteRespuestaFromOpciones();
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			axios.post('/api/reactivos', {
				"competencia" : this.reactivo.competencia,
				"tipo" : this.reactivo.tipo,
				"estatus" : 2,
				"profesor" : 1,
				"pregunta" : this.reactivo.pregunta,
				"respuesta" : this.reactivo.respuesta,
				"text" : this.reactivo.text,
				"opciones" : this.reactivo.opciones
			},{ headers: { Authorization: "Bearer " + this.token }})
			.then(response => {
				this.$toastr('success', 'Reactivo added successfully');
				this.resetReactivo();
				console.log(response);
			})
			.catch(e => {
				console.log(e);
			});
		})
		.catch(e=>{
			console.log(e);
		});
	},

	resetReactivo() {
		this.reactivo.tipo = 0;
		this.reactivo.competencia = 0;
		this.reactivo.text = '';
		this.reactivo.pregunta = '';
		this.reactivo.opciones = {};
		this.reactivo.respuesta = '';
	},

	deleteRespuestaFromOpciones() {
		for(var key in this.reactivo.opciones) {
			if (this.reactivo.respuesta === this.reactivo.opciones[key]) {
				delete this.reactivo.opciones[key];
			}
		}
	}
}
}
</script>