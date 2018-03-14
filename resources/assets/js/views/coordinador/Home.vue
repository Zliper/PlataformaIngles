<template>
	<div>
		<h2>Reactivos</h2>
		<h3>Validación de reactivos </h3>

		<div v-for="reactivo in reactivos" class="card card-body mb-3">

			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Ingles 1</th>
						<th scope="col">Lic. Karla Alvez Dominguez</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table-secondary">
						<th scope="row">Unidad 3</th>
						<td>3.1.2 - Verbo to BE</td>
					</tr>
					<tr>
						<th scope="row"> {{ reactivo.pregunta }} </th>
						<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non cupiditate vitae quaerat.</td>
					</tr>
					<tr class="table-success">
						<th scope="row">Opcion 1</th>
						<td>Jacob</td>
					</tr>
					<tr>
						<th scope="row">Opcion 2</th>
						<td>Larry</td>
					</tr>
					<tr>
						<th scope="row">Opcion 3</th>
						<td>Larry</td>
					</tr>
					<tr>
						<th scope="row">Opcion 4</th>
						<td>Larry</td>
					</tr>
				
					<div class="row">
						<div class="col-10">
							<a href="#" class="btn btn-success ">Aceptar</a>
							<a href="#" class="btn btn-warning">Denegar</a>
						</div>
						<div class="col-2 ">
							<a href="#" class="btn btn-info">Pendiente</a>
						</div>
					</div>

				</tbody>
			</table>
			<!--<router-link :to="{ name: 'grupos' }" class="nav-link">Hello World</router-link>-->
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
			token: '',
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
		fetchReactivos() {
			axios.get('/api/reactivos', { headers: { Authorization: "Bearer " + this.token } })
			.then(response => {
				console.log(response.data.data.reactivos);
				this.reactivos = response.data.data.reactivos;
			})
			.catch(e => {
				console.log(e);
			});
		}
	}
}
</script>