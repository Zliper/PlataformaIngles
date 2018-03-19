<template>
	<div>

		<div v-if="errors.length" class="alert alert-danger">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="text-center mt-3 mb-3">Grupos</h3>
		<hr>
		
		<div class="d-flex justify-content-center mb-3 ">
			<form v-on:submit.prevent="checkForm" class="form-inline">
				<div class="form-group mr-3">
					<label for="grupo" >Grupo</label>
					<input v-model="grupo.grupo" id="grupo" class="form-control" type="text" placeholder="grupo">
				</div>
				
				<div class="form-group mr-3">
					<label for="carrera">Carrera</label>
					<select v-model="grupo.carrera.id" id="carrera" class="form-control">
						<option selected>Choose...</option>
						<option v-for="c in carreras" v-bind:value="c.id"> {{ c.carrera }} </option>
					</select>
				</div>

				<div class="form-group mr-3">
					<label for="materia">Materia</label>
					<select v-model="grupo.materia.id" id="materia" class="form-control">
						<option selected>Choose...</option>
						<option v-for="m in materias" v-bind:value="m.id"> {{ m.materia }} </option>
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>

<!-- 		<div class="card">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Grupo</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="g in grupos">
							<th> {{ g.grupo }} </th>
						</tr>
					</tbody>
				</table>
			</div>
		</div> -->
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
			grupo:{
				carrera:{},
				materia:{}
			},
			token: '',
			errors: [],
			grupos: [],
			carreras: [],
			materias: [],
		}
	},

	created() {
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			this.fetchGrupos();
			this.fetchMaterias();
			this.fetchCarreras();
		})
		.catch(e => {
			console.log(e);
		});
	},

	methods:{
		fetchGrupos(page_url = '/api/grupos'){
			axios.get(page_url, { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				console.log(response.data.data);
				this.grupos = response.data.data.grupos;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchMaterias(page_url = '/api/materias?year=' + new Date().getFullYear().toString()) {
			let vm = this; 
			
			axios.get(page_url, { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				console.log(response.data.data);
				this.materias = response.data.data.materias;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchCarreras(page_url = '/api/carreras') {
			axios.get(page_url, { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				console.log(response.data.data);
				this.carreras = response.data.data.carreras;
			})
			.catch(e => {
				console.log(e);
			});
		},

		checkForm() {
			if (this.grupo.grupo && this.grupo.carrera.id && this.grupo.materia.id) {
				this.addGrupo();
			}

			this.errors = [];

			if (!this.grupo.grupo) this.errors.push('Grupo is required');
			if (!this.grupo.carrera.id) this.errors.push('Carrera is required');
			if (!this.grupo.materia.id) this.errors.push('Materia is required');	
		},

		addGrupo() {
			axios.post('/api/login', this.data)
			.then(response => {
				this.token = response.data.data.api_token;

				axios.post('/api/grupos', {
					"grupo" :   this.grupo.grupo.toUpperCase(),
					"carrera" : this.grupo.carrera.id,
					"materia" : this.grupo.materia.id
				}, { headers: { Authorization: "Bearer " + this.token } })
				.then(response => {
					this.grupo.grupo = '';
					this.grupo.carrera.id = 0;
					this.grupo.materia.id = 0;
					this.$toastr('success', 'Grupo added successfully');
				})
				.catch(e => {
					console.log(e);
				});
			})
			.catch(e => {
				console.log(e);
			});
		}
	}
}
</script>

<style scoped>
label {
	margin-right: 10px;
}
</style>