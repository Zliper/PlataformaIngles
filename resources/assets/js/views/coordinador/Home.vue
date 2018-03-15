<template>
	<div>
		<h3 class="title-component text-center">Reactivos Aprobados </h3>
<!-- 		<template v-if="sortType==='Aprobado'">
			<h3 class="title-component text-center">Reactivos Aprobados </h3>
		</template>

		<template v-else>
			<h3 class="title-component text-center">Validación de reactivos </h3>
		</template>

		<div class="form-row mb-5">
			<select @change="sortBy(sortType)" v-model="sortType" class="form-control col-sm-4">
				<option selected value="Espera">Por validar</option>
				<option value="Aprobado">Validados</option>
			</select>
		</div> -->

		<div v-for="reactivo in reactivos" class="card mb-5">
			<div class="card-body">
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Profesor</th>
							<th scope="col"> {{ reactivo.relationships[4].name  + " " +   reactivo.relationships[4].apellido }} </th>
						</tr>
					</thead>

					<tbody>			
						<tr>
							<th>Id</th>
							<td> {{ reactivo.id }} </td>
						</tr>
						<tr>
							<th>Competencia</th>
							<td>
								{{ reactivo.relationships[1].competencia }}
							</td>
						</tr>
						<tr>
							<th>Tipo Reactivo</th>	
							<td>
								{{ reactivo.relationships[2].tipo }}
							</td>
						</tr>

						<template v-if="reactivo.texto">
							<tr>
								<th> Texto/Url </th>
								<td> {{ reactivo.texto }} </td>
							</tr>
						</template>

						<tr>
							<th>Pregunta</th>
							<td> {{ reactivo.pregunta }} </td>
						</tr>

						<tr class="table-success">
							<th>Respuesta</th>
							<td> {{ reactivo.respuesta }} </td>
						</tr>				

						<tr v-for="(value, key, index) in reactivo.relationships[0].opciones">
							<th>Opción {{ index }}</th>
							<td>
								{{ value.opcion }}
							</td>
						</tr>
					</tbody>
				</table>

				<div class="row">
					<div class="offset-sm-8 col-sm-4 text-center">
						<a @click="validateReactivo(reactivo.id)"   href="#" class="btn btn-primary ">Aceptar</a>
						<a @click="deleteReactivo(reactivo.id)" href="#" class="btn btn-danger">Denegar</a>
					</div>
				</div>
			</div>
		</div>
		
		<nav aria-label="Page navigation example">
			<ul class="pagination">
				<li v-bind:class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
					<a @click="fetchReactivos(pagination.prev_page_url + '&by=Espera')" class="page-link" href="#">Previous</a>
				</li>
				
				<li  v-for="n in pagination.last_page" v-bind:class="[{ active: pagination.current_page==n}]" class="page-item">
					<a  @click="fetchReactivos(pagination.url+ n +'&by=Espera')" class="page-link" href="#"> {{ n }} </a>
				</li>

				<li v-bind:class="[{ disabled: !pagination.next_page_url }]" class="page-item">
					<a @click="fetchReactivos(pagination.next_page_url + '&by=Espera' )" class="page-link" href="#">Next</a>
				</li>
			</ul>
		</nav>
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
			token: '',
			sortType: '',
			pagination: {},
			reactivos: [],
		}
	},

	created() {
		axios.post('/api/login', this.data)
		.then(response => {
			this.token = response.data.data.api_token;
			this.fetchReactivos();
		})
		.catch(e => {
			console.log(e);
		});
	},

	methods:{
		login(exec) {
			axios.post('/api/login', this.data)
			.then(response => {
				this.token = response.data.data.api_token;
				exec();
			})
			.catch(e => {
				console.log(e);
			});
		},

		fetchReactivos(page_url = '/api/reactivos?by=Espera') {
			let vm = this; 

			axios.get(page_url, { headers: { Authorization: "Bearer " + this.token } })
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
			axios.post('/api/login', this.data)
			.then(response => {
				this.token = response.data.data.api_token;
				axios.put('/api/reactivos/' + id, {  "estatus_id" : 1 } , { headers: { Authorization: "Bearer " + this.token } })
				.then(response => {
					console.log("Updated" + response);
					this.fetchReactivos();
				})
				.catch(e => {
					console.log(e);
				});
			})
			.catch(e => {
				console.log(e);
			});
		},

		deleteReactivo(id) {
			this.delete(id);
		},

		delete(id) {
			axios.post('/api/login', this.data)
			.then(response => {
				this.token = response.data.data.api_token;
				axios.delete('/api/reactivos/' + id, { headers: { Authorization: "Bearer " + this.token } })
				.then(response => {
					this.fetchReactivos();
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