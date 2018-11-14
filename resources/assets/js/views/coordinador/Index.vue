 <template>
	<div class="container mt-5">
		<div class="row">
			<div class="col">
				<h3 class="display-4 titles">Bienvenido </h3>
				<hr>
				<div class="jumbotron">
					<p class="display-4 text-center">Panel</p>
					<p class="lead text-center">En esta area encontraras tarjetas con algunas notificaciones y datos que quizas puedan servirte.</p>

					<div class="row justify-content-center">
						<div class="col-sm-12 col-md-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">
									Reactivos
								</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-warning"> {{ espera }}</span></h3>
									<h5 class="card-title text-center">Reactivos por validar</h5>
									<p class="card-text">La mayoria de estos reactivos aun no se han validados o se han agregados recientemente.</p>
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">Reactivos</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-success"> {{ aprobados }}</span></h3>
									<h5 class="card-title text-center">Validados</h5>
									<p class="card-text">Cantidad de reactivos validados en la base de datos listos para ser usados en los cuestionarios.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				aprobados: 0,
				espera: 0
			}
		},

		created() {
			this.fetchAprobados();
			this.fetchEspera();
		},

		methods: {
			fetchAprobados() {
				axios.get('/api/reactivos?count=Aprobado')
				.then(response => {
					this.aprobados = response.data;
				})
				.catch(e => {
					console.log(e);
				});
			},

			fetchEspera() {
				axios.get('/api/reactivos?count=Espera')
				.then(response=>{
					this.espera = response.data;
				})
				.catch(e=>{
					console.log(e);
				});
			}
		}
	}
</script>