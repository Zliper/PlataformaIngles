<template>
	<div>
		<h3>Grupos</h3>
		<hr>

<!-- 		<div v-if="errors.length" class="alert alert-danger">
			<h5><b>Please correct the following error(s):</b></h5>

			<ul>
				<li v-for="e in errors">
					{{ e }}
				</li>
			</ul>
		</div> -->

		<form v-on:click.prevent="checkForm" class="row justify-content-md-center">
			<div class=" col-8 input-group ">
				<select v-model="materia" class="form-control">
					<option selected>Choose...</option>
					<option v-for="m in materias" v-bind:value="m.id">
						{{ m.materia }}
					</option>
				</select>
				<input v-model="group" type="text" class="form-control" placeholder="grupo">
				<div class="input-group-append">
					<button type="submit" class="btn btn-primary" >Agregar</button>
				</div>
			</div>
		</form>
		<div class="row justify-content-md-center grupo-list">
			<div class="col-sm-8">
				<table class="table table-bordered text-center">
					<thead class="thead-dark"> 
						<tr>	 
							<th>Grupo</th>
							<th>Período</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="grupo in grupos">
							<!--<th> {{ grupo.relationships[0].materias[0].id }} </th>-->
							<th> {{ grupo.grupo }} </th>
							<th> {{ grupo.periodo }} </th>
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
			group: '',
			materia: '',
			token: '',
			errors: [],
			grupos: [],
			materias: [],
		}
	},

	created() {
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			this.fetchGrupos();
			this.fetchMateria();
		})
		.catch(e => {
			console.log(e);
		});
	},

	methods:{
		fetchGrupos() {
			axios.get('/api/grupos', { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				this.grupos = response.data.grupos;
				console.log(response.data.grupos[0].relationships[0].materias[0].id)
			})
			.catch(e => {
				console.log(e);
			});
		},
		fetchMateria() {
			axios.get('/api/materias', { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				console.log(response)
				this.materias = response.data.materias;
			})
			.catch(e => {
				console.log(e);
			});
		},
		checkForm() {
			if (this.group && this.materia) return true;
			this.errors = [];

			if (!this.materia) this.errors.push('Materia required');
			if (!this.group) this.errors.push('Group required');
		},

		addGrupo() {
			console.log("Added")
		}
	}
}
</script>