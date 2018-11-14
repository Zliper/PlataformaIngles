<template>
	<div>

		<div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="titles">Niveles</h3>
		<hr>
		
		<form v-on:submit.prevent="checkForm">
			<div class="form-row">
				<div class="col-md-4">
					<input v-model="materia.materia" id="materia" class="form-control inputs" type="text" onkeypress="return event.charCode >= 48" placeholder="Nivel">
				</div>
				<div class="col-md-4">
					<select id="periodo" class="form-control inputs" v-model="materia.periodo">
						<option>Ene-Abril</option>
						<option>Mayo-Ago</option>
						<option>Sep-Dic</option>
					</select>
				</div>
				<div class="col-md-4">
					<button type="submit" class="btn btn-primary btn-block inputs">Agregar</button>
				</div>
			</div>
		</form>
				
		<div class="form-row col-sm-3 mt-3 mb-3">
			<label for="filter">Filtrar por año</label>
			<select v-model="year" @change="yearChanges(year)" id="fiter" class="form-control">
				<option selected disabled>Año</option>
				<option v-for="y in years" v-bind:value="y.year"> {{ y.year }} </option>
			</select>
		</div>
		
		<card-transition tag="div">
			<div class="card" :key="1">
				<div class="card-body">
					<div class="table-responsive-md">
						<table class="table table-hover text-center">
							<thead>
								<tr>
									<th>Nivel</th>
									<th>Periodo</th>
									<th>Año</th>
									<!--<th>Informacion</th>-->
								</tr>
							</thead>

							<tbody>
								<tr v-for="materia in materias">
									<th> {{ materia.materia }} </th>
									<th> {{ materia.periodo }} </th>
									<th> {{ materia.year }} </th>
									<!--<th> <a href="" class="btn btn-info">Info {{ materia.id }} </a></th>-->
								</tr>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</card-transition>
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
			year: '',
			materia: {},
			token: '',
			errors: [],
			materias: [],
			years: [],
		}
	},

	created() {
		this.fetchMaterias();
		this.fetchYears();
	},

	methods:{
		fetchMaterias(page_url = '/api/materias?year=' + new Date().getFullYear().toString()) {
			let vm = this; 
			axios.get(page_url)
			.then(response => {
				this.materias = response.data.data.nivel;
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
			axios.post('/api/materias', {
				"materia" : this.materia.materia,
				"periodo" : this.materia.periodo,
				"year" : this.materia.year
			}, { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				this.materia.materia = '';
				this.materia.periodo = '';
				this.fetchMaterias();
				this.$toastr('success', 'Materia added successfully');
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchYears(page_url = '/api/materias?years=2') {
			axios.get(page_url)
			.then(response => {
				console.log(response.data);
				this.years = response.data[0];
			})
			.catch(e => {
				console.log(e);
			});
		},

		yearChanges() {
			this.fetchMaterias('/api/materias?year=' + this.year);
		}
	}
}
</script>