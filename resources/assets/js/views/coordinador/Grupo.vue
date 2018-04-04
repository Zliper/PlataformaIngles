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
		
		<div class="d-flex justify-content-center mb-3 ">
			<form v-on:submit.prevent="checkForm" class="form-inline">
				<div class="form-group inputs">
					<label class="filters" for="grupo" >Grupo</label>
					<input v-model="grupo.grupo" id="grupo" class="form-control" type="text" placeholder="grupo">
				</div>
				
				<div class="form-group inputs">
					<label class="filters" for="carrera">Carrera</label>
					<select v-model="grupo.carrera.id" id="carrera" class="form-control">
						<option v-for="c in carreras" v-bind:value="c.id"> {{ c.carrera }} </option>
					</select>
				</div>
				
				<div class="form-group inputs">
					<label class="filters" for="materia">Nivel</label>
					<select v-model="grupo.materia.id" id="materia" class="form-control">
						<option v-for="m in materias" v-bind:value="m.id"> {{ m.materia }} </option>
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
			</form>
		</div>
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
				this.materias = response.data.data.materias;
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