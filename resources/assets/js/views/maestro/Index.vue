<template>
	<div class="container mt-5">
		<div class="row">
			<div class="col">
				<h3 class="display-4 titles">Bienvenido </h3>
				<hr>
				<div class="jumbotron">
					<h4 class="display-4">Panel Maestro </h4>
					<p class="lead">En esta area encontraras tarjetas con algunas notificaciones y datos que quizas puedan servirte.</p>

					<div class="row justify-content-center">
						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">
									Reactivos
								</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-success"> 20 </span></h3>
									<h5 class="card-title text-center">Reactivos por validar</h5>
									<p class="card-text">La mayoria de estos reactivos aun no se han validados o se han agregados recientemente.</p>
								</div>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">Reactivos</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-warning">9</span></h3>
									<h5 class="card-title text-center">Reactivos rechazados</h5>
									<p class="card-text">Estos reactivos han sido puestos con un estatus de pendiente por validar por el coordinador</p>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">Reactivos</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-warning"> 2 </span></h3>
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

		}
	}
}
</script>