<template>
	<div>
		<div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="titles">Grupos</h3>
		<hr>
		
		<form v-on:submit.prevent="checkForm">
			<div class="form-row">
				<div class="col-md-3">
					<input v-model="grupo.grupo" id="grupo" class="form-control inputs" type="text" placeholder="grupo">
				</div>
				<div class="col-md-3">
					<select v-model="grupo.carrera.id" id="carrera" class="form-control inputs">
						<option v-for="c in carreras" v-bind:value="c.id"> {{ c.carrera }} </option>
					</select>
				</div>
				<div class="col-md-3">
					<select v-model="grupo.materia.id" id="materia" class="form-control inputs">
						<option v-for="m in materias" v-bind:value="m.id"> {{ m.materia }} </option>
					</select>
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-primary btn-block inputs">Agregar</button>
				</div>
			</div>
		</form>

<!-- 		<div class="d-flex justify-content-center mb-3 ">
			<form v-on:submit.prevent="checkForm">
				<div class="form-row justify-content-center">
					<div class="col-auto">
						<div class="form-group inputs">
							<label class="filters" for="grupo" >Grupo</label>
							<input v-model="grupo.grupo" id="grupo" class="form-control" type="text" placeholder="grupo">
						</div>
					</div>
					
					<div class="col-auto">
						<div class="form-group inputs">
							<label class="filters" for="carrera">Carrera</label>
							<select v-model="grupo.carrera.id" id="carrera" class="form-control">
								<option v-for="c in carreras" v-bind:value="c.id"> {{ c.carrera }} </option>
							</select>
						</div>
					</div>

					<div class="col-auto">
						<div class="form-group inputs">
							<label class="filters" for="materia">Nivel</label>
							<select v-model="grupo.materia.id" id="materia" class="form-control">
								<option v-for="m in materias" v-bind:value="m.id"> {{ m.materia }} </option>
							</select>
						</div>
					</div>

					<div class="col-auto">
						<div class="form-group inputs mt-4">
							<button type="submit" class="btn btn-primary btn-block">Agregar</button>
						</div>
					</div>
				</div>
			</form>
		</div> -->
		
		<!-- <div class="row justify-content-center">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive-md">
						<table class="table table-hover text-center">
							<thead>
								<tr>
									<th>Grupo</th>
									<th>Detalles</th>
								</tr>
							</thead>
							
							<tbody>
								<tr v-for="group in grupos">
									<td>
										{{ group.grupo }}
									</td>
									<td>
										<router-link :to="{ name: 'grupoDetails', params: { grupoId: group.id } }" class="nav-link text-white">Detalles</router-link>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</template>

<script>

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
		this.fetchGrupos();
		this.fetchMaterias();
		this.fetchCarreras();
	},

	methods:{
		fetchGrupos(page_url = '/api/grupos'){
			axios.get(page_url)
			.then(response => {
				console.log(response.data.data);
				this.grupos = response.data.data.grupos;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchMaterias(page_url = '/api/materias?year=' + new Date().getFullYear().toString()) {
			axios.get(page_url)
			.then(response => {
				console.log(response.data.data);
				this.materias = response.data.data.nivel;
				console.log(materias);
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchCarreras(page_url = '/api/carreras') {
			axios.get(page_url)
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
			axios.post('/api/grupos', {
				"grupo" :   this.grupo.grupo.toUpperCase(),
				"carrera" : this.grupo.carrera.id,
				"materia" : this.grupo.materia.id
			})
			.then(response => {
				this.grupo.grupo = '';
				this.grupo.carrera.id = 0;
				this.grupo.materia.id = 0;
				this.$toastr('success', 'Grupo added successfully');
			})
			.catch(e => {
				console.log(e);
			});
		}
	}
}
</script>