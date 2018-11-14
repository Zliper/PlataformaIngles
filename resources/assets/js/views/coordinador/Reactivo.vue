<template>
	<div>
		<template v-if="sortType==='Aprobado'">
			<h3 class="titles">Reactivos Aprobados </h3>
		</template>

		<template v-else>
			<h3 class="titles">Reactivos por aprobar </h3>
		</template>

		<hr>

		<div class="form-row col-sm-3 mb-5">
			<label for="filter">Filtrar por </label>
			<select @change="sortBy(sortType)" v-model="sortType" id="filter" class="form-control">
				<option selected value="Espera">Sin validar</option>
				<option value="Aprobado">Validados</option>
			</select>
		</div>

		<card-transition>

		<div class="card mb-5" v-for="reactivo in reactivos" :key="reactivo.id" >
			<div class="card-body">
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Profesor</th>
							<th scope="col"> {{ reactivo.relationships['autor'].name  + " " +   reactivo.relationships['autor'].apellido }} </th>
						</tr>
					</thead>

					<tbody>			
						<tr>
							<th>Nivel </th>
							<td>
								{{ reactivo.relationships['nivel'].materia }}
							</td>
						</tr>

						<tr>
							<th>Unidad </th>
							<td>
								{{ reactivo.relationships['punto_gramatical'].unidad }}
							</td>
						</tr>
						
						<tr>
							<th>Punto Gramatical</th>
							<td>
								{{ reactivo.relationships['punto_gramatical'].punto_gramatical }}
							</td>
						</tr>
						
						<tr>
							<th>Reactivo para </th>
							<td>
								{{ reactivo.relationships['catalogo'].catalogo }}
							</td>
						</tr>
						
						<tr>
							<th>Competencia</th>
							<td>
								{{ reactivo.relationships['competencia'].competencia }}
							</td>
						</tr>
						<tr>
							<th>Tipo Reactivo</th>	
							<td>
								{{ reactivo.relationships['tipo_reactivo'].tipo }}
							</td>
						</tr>

						<template v-if="reactivo.relationships.text">
							<tr>
								<th> Texto/Url </th>
								<td> {{ reactivo.relationships['text'].texto }} </td>
							</tr>
						</template>

						<tr>
							<th>Pregunta</th>
							<td> {{ reactivo.attributes.pregunta }} </td>
						</tr>

						<tr class="table-success">
							<th>Respuesta</th>
							<td> {{ reactivo.attributes.respuesta }} </td>
						</tr>				

						<tr v-for="(value, key, index) in reactivo.relationships['opciones'].opciones">
							<th>Opción {{ index }}</th>
							<td>
								{{ value.opcion }}
							</td>
						</tr>
					</tbody>
				</table>
				
				<div v-if="sortType !== 'Aprobado'" class="row justify-content-start">
					<div class="col-md-2 col-sm-12">
						<a @click="validateReactivo(reactivo.id)" href="#" class="btn btn-primary btn-block inputs">Aceptar</a>
					</div>
					<div class="col-md-2 col-sm-12">
						<a @click="deleteReactivo(reactivo.id)" href="#" class="btn btn-danger btn-block inputs">Denegar</a>
					</div>
					<div class="col-md-2 col-sm-12">
						<a href="#" class="btn btn-info btn-block inputs">Comentario</a>
					</div>
				</div>
			</div>
		</div>
	</card-transition>

	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
				<a @click="fetchReactivos(pagination.prev_page_url + '&by=Espera')" class="page-link" href="#">Anterior</a>
			</li>

			<li  v-for="n in pagination.last_page" v-bind:class="[{ active: pagination.current_page==n}]" class="page-item">
				<a  @click="fetchReactivos(pagination.url+ n +'&by=Espera')" class="page-link" href="#"> {{ n }} </a>
			</li>

			<li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
				<a @click="fetchReactivos(pagination.next_page_url + '&by=Espera' )" class="page-link" href="#">Siguiente</a>
			</li>
		</ul>
	</nav>
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
			token: '',
			sortType: '',
			pagination: {},
			reactivos: [],
		}
	},

	created() {
		this.fetchReactivos();
		console.log(reactivo);
	},

	methods:{
		fetchReactivos(page_url = '/api/reactivos?by=Espera') {
			let vm = this; 

			axios.get(page_url)
			.then(response => {
				console.log(response.data);
				this.reactivos = response.data.data.reactivos;
				vm.makePagination( response.data.meta, response.data.links )
			})
			.catch(e => {
				console.log(e);
			});
		},

		makePagination(meta, links) {
			let pagination = {
				current_page: meta.current_page,
				last_page: meta.last_page,
				next_page_url: links.next,
				prev_page_url: links.prev,
				prev_next_url: links.prev_next_url,
				url: meta.path + '?page='
			}

			this.pagination = pagination;
		},

		sortBy(sortType) {
			if (sortType === "Aprobado") {
				this.fetchReactivos('/api/reactivos?by=Aprobado');
			} else if(sortType === "Espera") {
				this.fetchReactivos();
			}
		},

		validateReactivo(id) {
			this.update(id);
		},

		update(id) {
			axios.put('/api/reactivos/' + id, {  "estatus_id" : 1 } , { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				this.fetchReactivos();
				this.$toastr('success', 'Reactivo added successfully');
			})
			.catch(e => {
				console.log(e);
			});
		},

		deleteReactivo(id) {
	    	if(confirm("¿Seguro que borrar el reactivo?")){
				this.delete(id);
			}
		},

		delete(id) {
			axios.delete('/api/reactivos/' + id)
			.then(response => {
				this.fetchReactivos();
				this.$toastr('warning', 'Reactivo was deleted');
			})
			.catch(e => {
				console.log(e);
			});
		},
	}
}
</script>