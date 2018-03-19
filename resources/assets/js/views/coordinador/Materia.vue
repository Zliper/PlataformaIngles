<template>
	<div>

		<div v-if="errors.length" class="alert alert-danger">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h2 class="text-center mt-3 mb-3">Materias</h2>
		<hr>
		
		<div class="d-flex justify-content-center mb-3 ">
			<form v-on:submit.prevent="checkForm" class="form-inline">
				<div class="form-group mr-3">
					<label for="materia" >Materia</label>
					<input v-model="materia.materia" id="materia" class="form-control" type="text" placeholder="materia">
				</div>
				
				<div class="form-group mr-3">
					<label for="periodo">Periodo</label>
					<select id="periodo" class="form-control" v-model="materia.periodo">
						<option selected>Choose...</option>
						<option>Ene-Abril</option>
						<option>Mayo-Ago</option>
						<option>Sep-Dic</option>
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>
		
		<div class="form-row col-sm-3 mt-3 mb-3">
			<label for="filter">filter by year</label>
			<select id="fiter" class="form-control">
				<option selected>Year...</option>
				<option>2017</option>
				<option>2018</option>
				<option>2019</option>
			</select>
		</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th>Materia</th>
							<th>Periodo</th>
							<th>Año</th>
							<th>Info</th>
						</tr>
					</thead>

					<tbody>
						<tr v-for="materia in materias">
							<th> {{ materia.materia }} </th>
							<th> {{ materia.periodo }} </th>
							<th> {{ materia.year }} </th>
							<th> <a href="" class="btn btn-info">Info {{ materia.id }} </a></th>
						</tr>
					</tbody>
				</table>
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
			materia: {},
			token: '',
			errors: [],
			materias: [],
		}
	},

	created() {
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			this.fetchMaterias();
		})
		.catch(e => {
			console.log(e);
		});
	},

	methods:{
		fetchMaterias(page_url = '/api/materias') {
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

		checkForm() {		
			if (this.materia.materia && this.materia.periodo) {
				this.materia.year = new Date().getFullYear();
				this.addMateria();
			}

			this.errors = [];

			if (!this.materia.materia) this.errors.push('Materia is required');
			if (!this.materia.periodo) this.errors.push('Periodo is required');
		},
		
		addMateria() {
			
			axios.post('/api/login', this.data)
			.then(response => {
				this.token = response.data.data.api_token;


				axios.post('/api/materias', {
					"materia" : this.materia.materia,
					"periodo" : this.materia.periodo,
					"year" : this.materia.year
				}, { headers: { Authorization: "Bearer " + this.token } })
				.then(response => {
					console.log("Updated" + response);
					this.materia.materia = '';
					this.materia.periodo = '';

					this.fetchMaterias();
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