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
		
		<form class="mb-4" v-on:submit.prevent="checkForm">
			<div class="form-row">
				<div class="col-md-3 col-sm-12 ">
					<input v-model="punto.unidad" name="unidad" type="number" onkeypress="return event.charCode >= 48" class="form-control inputs" placeholder="Unidad">
				</div>
				<div class="col-md-3 col-sm-12">
					<input v-model="punto.punto_gramatical" type="text" class="form-control inputs" placeholder="Punto Gramatical">
				</div>
				<div class="col-md-3 col-sm-12">
					<select v-model="punto.materia" id="periodo" class="form-control inputs">
						<option selected disabled value="">Nivel</option>
						<option v-for="materia in materias" v-bind:value="materia.id"> {{ materia.materia }} </option>
					</select>
				</div>
				<div class="col-md-3 col-sm-12">
					<button type="submit" class="btn btn-primary btn-block">Guardar</button>
				</div>
			</div>
		</form>
		
		<div class="card">
			<div class="card-body">
				<div class="table-responsive-md">
					<table class="table table-hover text-center">
						<thead>
							<tr>
								<th>Unidad</th>
								<th>Punto Gramatical</th>
								<th>Materia</th>
							</tr>
						</thead>

						<tbody>
							<tr v-for="punto in puntos">
								<th> {{ punto.unidad }} </th>
								<th> {{ punto.punto_gramatica }} </th>
								<th> {{ punto.materia }} </th>
							</tr>
						</tbody>
					</table>
				</div>
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
        this.punto.materia = '';
	},

	methods: {
		fetchPuntosGramaticals(page_url='/api/puntos?year=' + new Date().getFullYear().toString()) {
			axios.get(page_url)
			.then(response => {
				this.puntos = response.data;
				console.log(response.data)
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchMaterias(page_url = '/api/materias') { 
			axios.get(page_url)
			.then(response => {
				this.materias = response.data.data.nivel;
			})
			.catch(e => {
				console.log(e);
			});
		},

		add() {
			let punto = {
				"unidad" : this.punto.unidad,
				"punto_gramatica": this.punto.punto_gramatical,
				"materia_id": this.punto.materia
			};

			axios.post('/api/puntos', punto)
			.then(response => {
				this.fetchPuntosGramaticals();
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