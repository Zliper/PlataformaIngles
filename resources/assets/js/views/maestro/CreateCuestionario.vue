<template>
    <div>
        <div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>
        
        <h3 class="titles">Nuevo cuestionario</h3>
        <hr>
        
        <form class="mb-4" v-on:submit.prevent="checkForm">
        <input v-model="cuestionario.titulo" class="form-control inputs" placeholder="Titulo"></input>
        <select v-model="cuestionario.materia" @change="puntosBy(cuestionario.materia)" id="materia" class="form-control inputs">
            <option disabled value="" selected>Nivel</option>
			<option v-for="materia in materias" v-bind:value="materia.id"> {{ materia.materia }} </option>
        </select>
        <select v-model="cuestionario.tipo" id="tipo" hint="s" class="form-control inputs">
            <option selected disabled value="">Tipo de examen</option>
			<option v-for="tipo in tipos" v-bind:value="tipo.id"> {{ tipo.tipo }} </option>
        </select>
        <select v-model="cuestionario.punto_gramatical" id="punto" hint="s" class="form-control inputs">
            <option selected disabled value="">Punto gramatical</option>
			<option v-for="punto in puntos" v-bind:value="punto.id"> {{ punto.punto_gramatical }} </option>
        </select>
        
        <div class="row justify-content-center inputs">
				<div class="col-md-3 col-sm-12 inputs">
					<div class="card text-white bg-secondary">
						<div class="card-body">
							<h3 class="card-title text-center">Reading</h3>
							<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" v-model="cuestionario.cantidadR" placeholder="Cantidad">
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-12 inputs">
					<div class="card text-white bg-secondary">
						<div class="card-body">
							<h3 class="card-title text-center">Listening</h3>
				            <input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" v-model="cuestionario.cantidadL" placeholder="Cantidad">
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-12 inputs">
					<div class="card text-white bg-secondary">
						<div class="card-body">
							<h3 class="card-title text-center">Writing</h3>
				            <input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" v-model="cuestionario.cantidadW" placeholder="Cantidad">
						</div>
					</div>
				</div>
			</div>
        
        <textarea v-model="cuestionario.instruccion" class="form-control inputs" placeholder="Instrucciones"></textarea>
        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </form>
    </div>
</template>

<script>

export default {
	data() {
		return {
			materias: [],
			tipos: [],
			puntos: [],
			errors: [],
			cuestionario:{},
		}
	},

	created() {
		this.fetchMaterias();
        this.fetchTipos();
        this.fetchPuntos();
		this.clear();
	},

	methods: {
		fetchMaterias(page_url = '/api/materias') { 
			axios.get(page_url)
			.then(response => {
				this.materias = response.data.data.nivel;
			})
			.catch(e => {
				console.log(e);
			});
		},
        fetchTipos(page_url = '/api/cuestionarios') { 
			axios.get(page_url)
			.then(response => {
				this.tipos = response.data.data.catalogo;
			})
			.catch(e => {
				console.log(e);
			});
		},
        
        puntosBy(materia) {
			this.fetchPuntos('/api/puntos?materia=' + materia);
            console.log('/api/puntos?materia=' + materia);
			console.log("materia= "+materia);
		},
        
        fetchPuntos(page_url = '/api/puntos') { 
            console.log(page_url);
			axios.get(page_url)
			.then(response => {
				this.puntos = response.data.data.puntos_gramaticales;
                console.log(response);
			})
			.catch(e => {
				console.log("Error?: "+e);
			});
		},

        add() {
			let cuestionario = {
                "profesor_id": '1',
				"materia_id": this.cuestionario.materia,
				"catalogo_id" : this.cuestionario.tipo,
				"alumno_id": '1',
                "punto_gramatical": this.cuestionario.punto_gramatical,
                "cantidad_reading": this.cuestionario.cantidadR,
                "cantidad_listening": this.cuestionario.cantidadL,
                "cantidad_writing": this.cuestionario.cantidadW,
                "nota": this.cuestionario.titulo,
                "instruccion": this.cuestionario.instruccion,
                "status": '1'
			};

			axios.post('/api/evaluaciones', cuestionario)
			.then(response => {
				this.clear();
                this.$router.push({ name: 'cuestionarios'})
				this.$toastr('success', 'Cuestionario added successfully');
			})
			.catch(e => {
				console.log(this.cuestionario.punto_gramatical);
				console.log("errorSQL: "+e);
			});
		},

		update() {

		},

		delete() {

		},
        
        clear() {
            this.cuestionario.tipo = '';
			this.cuestionario.materia = '';
			this.cuestionario.punto_gramatical = '';
			this.cuestionario.cantidadR = '';
			this.cuestionario.cantidadL = '';
			this.cuestionario.cantidadW = '';
			this.cuestionario.titulo = '';
			this.cuestionario.instruccion = '';
        },

		checkForm() {
			if (this.cuestionario.tipo && this.cuestionario.materia && this.cuestionario.punto_gramatical && this.cuestionario.cantidadR && this.cuestionario.cantidadL && this.cuestionario.cantidadW && this.cuestionario.titulo && this.cuestionario.instruccion) {
				this.add();
			}

			this.errors = [];

			if (!this.cuestionario.materia) this.errors.push('Materia is required');
			if (!this.cuestionario.tipo) this.errors.push('Tipo is required');
			if (!this.cuestionario.punto_gramatical) this.errors.push('Punto gramatical is required');
			if (!this.cuestionario.cantidadR) this.errors.push('Cantidad de reactivos reading is required');
			if (!this.cuestionario.cantidadL) this.errors.push('Cantidad de reactivos listening is required');
			if (!this.cuestionario.cantidadW) this.errors.push('Cantidad de reactivos writing is required');
			if (!this.cuestionario.titulo) this.errors.push('Titulo is required');
			if (!this.cuestionario.instruccion) this.errors.push('Instrucciones is required');
		},

	},
}
</script>