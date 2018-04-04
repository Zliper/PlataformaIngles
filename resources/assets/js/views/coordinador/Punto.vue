<template>
	<div>
		<div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>

		<h3 class="titles">Puntos Gramaticales</h3>
		<hr>

		<div class="d-flex justify-content-center mb-3">
			<form v-on:submit.prevent="checkForm" class="form-inline">
				<div class="form-group inputs">
					<label class="filters" for="unidad">Unidad</label>
					<input v-model="punto.unidad" class="form-control" type="text" id="unidad" placeholder="Unidad">
				</div>

				<div class="form-group inputs" >
					<label class="filters" for="tema">Punto Gramatical</label>
					<input v-model="punto.punto_gramatical" class="form-control" id="tema" type="text" placeholder="Punto Gramatical">
				</div>

				<div class="form-group mr-3">
					<label class="filters" for="periodo">Nivel</label>
					<select v-model="punto.materia" id="periodo" class="form-control">
						<option v-for="materia in materias" v-bind:value="materia.id"> {{ materia.materia }} </option>
					</select>
				</div>

				<div class="form-group inputs">
					<button class="btn btn-primary" type="submit">Agregar</button>
				</div>
			</form>
		</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th>Unidad</th>
							<th>Punto Gramatical</th>
							<th>Materia</th>
						</tr>
					</thead>

					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			puntos: [],
			materias: [],
			errors: [],
			punto:{},
		}
	},
	created() {
		this.fetchPuntosGramaticals();
		this.fetchMaterias();
	},
	methods: {
		fetchPuntosGramaticals(page_url='/api/puntos') {
			axios.get(page_url)
			.then(response => {
				this.puntos = response.data.data.puntos_gramaticales;
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchMaterias(page_url = '/api/materias?year=' + new Date().getFullYear().toString()) { 
			axios.get(page_url)
			.then(response => {
				this.materias = response.data.data.materias;
			})
			.catch(e => {
				console.log(e);
			});
		},

		add() {
			let payload = {
				"unidad" : 1,
					"punto_gramatica": "lorem",
					"materia_id": 1
			};


			axios.post('/api/puntos', {
					"unidad" : this.punto.unidad,
					"punto_gramatica": this.punto.punto_gramatical,
					"materia_id": this.punto.materia
			})
			.then(response => {
				this.punto.unidad = '';
				this.punto.punto_gramatical = '';
				this.punto.materia = '';
				this.$toastr('success', 'Punto Gramatical added successfully');
			})
			.catch(e => {
				console.log(e);
			});
		},

		update() {

		},

		delete() {

		},

		checkForm() {
			if (this.punto.unidad &&  this.punto.punto_gramatical && this.punto.materia) {
				this.add();
			}

			this.errors = [];

			if (!this.punto.unidad) this.errors.push('Unidad is required');
			if (!this.punto.punto_gramatical) this.errors.push('Punto Gramatical is required');
			if (!this.punto.materia) this.errors.push('Materia is required');
		},

	},
}
</script>