<template>
    <div>
        <div v-if="errors.length" class="alert alert-danger error">
			<b>Please correct the following error(s):</b>
			<ul>
				<li v-for="e in errors"> {{ e }} </li>
			</ul>
		</div>
        
        <h3 class="titles"> {{ titulo }}</h3>

        <card-transition> 

		<div class="card mb-5" :key="cuestionarioSelected.id" v-if="datos">
			<div class="card-body">
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Titulo</th>
							<th scope="col"> {{cuestionarioSelected.nota}} </th>
						</tr>
					</thead>

					<tbody>	

						<tr>
							<th>Instrucciones</th>	
							<td>
								{{ cuestionarioSelected.instruccion }}
							</td>
						</tr>

						<tr>
							<th>Nivel</th>
							<td>
								{{ cuestionarioSelected.materia.materia }}
							</td>
						</tr>
						
						<tr>
							<th>Punto Gramatical</th>
							<td>
								{{ cuestionarioSelected.punto_gramatical }}
							</td>
						</tr>
						
						<tr>
							<th>Cuestionario para</th>
							<td>
								{{ cuestionarioSelected.tipo.catalogo }}
							</td>
						</tr>
						
						<tr>
							<th>Reactivos de reading</th>
							<td>
								{{ cuestionarioSelected.cantidad_reading }}
							</td>
						</tr>

						<tr>
							<th>Reactivos de writing</th>	
							<td>
								{{ cuestionarioSelected.cantidad_writing }}
							</td>
						</tr>

						<tr>
							<th>Reactivos de listening</th>	
							<td>
								{{ cuestionarioSelected.cantidad_listening }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</card-transition>
        
        <form class="mb-4" v-on:submit.prevent="checkForm">
            <div class="row justify-content-center inputs" v-if="datos">
				<div class="col-md-3 col-sm-12 inputs">
					<input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" v-model="aplicacion.duracion" placeholder="Duración del examen">
				</div>
				<div class="col-md-3 col-sm-12 inputs">
					<input type="datetime-local" class="form-control" v-model="aplicacion.fecha_hora" placeholder="Fecha y hora de aplicacion">
				</div>

				<div class="col-md-2 col-sm-12 inputs">
					<button type="submit" class="btn btn-primary btn-block">Guardar</button>
				</div>
			</div>
        </form>
    </div>
</template>

<script>

export default {
    props: ['cuestionarioSelected'],
    data() {
        return {
            cuestionario: [],
            aplicacion: [],
            errors: [],
            datos: false,
            titulo: 'No hay datos'
        }
    },
    mounted() {
        
        console.log(this.cuestionarioSelected);
        if (this.cuestionarioSelected) {
            this.cuestionario = this.cuestionarioSelected;
            console.log(this.cuestionarioSelected);
            this.titulo = 'Aplicar cuestionario'
			this.datos = true;
			axios.get('/api/puntos?id=' + this.cuestionarioSelected.punto_gramatical)
			.then(response => {
				this.cuestionarioSelected.punto_gramatical = response.data.data.puntos_gramaticales[0].punto_gramatical;
			})
			.catch(e => {
				console.log(e);
			});
        }
    },
    methods: {
        add() {
            console.log(this.aplicacion.fecha_hora);
            this.$router.push({ name: 'cuestionarios'})
			this.$toastr('success', 'El cuestionario ha sido programado correctamente');
        },

        checkForm() {
                if (this.aplicacion.duracion && this.aplicacion.fecha_hora) {
                    this.add();
                }

                this.errors = [];

                if (!this.aplicacion.duracion) this.errors.push('Duracion is required');
                if (!this.aplicacion.fecha_hora) this.errors.push('Fecha y hora is required');
        }
    }
}
</script>
    
<style>

</style>


