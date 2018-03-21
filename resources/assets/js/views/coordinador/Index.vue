<template>
	<div class="container mt-5">
		<div class="row">
			<div class="col">
				<h3 class="display-4 titles">Bienvenido </h3>
				<hr>
				<div class="jumbotron">
					<h4 class="display-4">Panel Coordinador</h4>
					<p class="lead">En esta area encontraras tarjetas con algunas notificaciones y datos que quizas puedan servirte.</p>

					<div class="row justify-content-center">
						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">
									Reactivos
								</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-success">25</span></h3>
									<h5 class="card-title text-center">Reactivos por validar</h5>
									<p class="card-text">La mayoria de estos reactivos aun no se han validados o se han agregados recientemente.</p>
<!-- 									<div class="d-flex justify-content-end">
										<button class="btn btn-primary btn-sm">ver</button>
									</div> -->
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
								<div class="card-header">Reactivos</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge badge-warning">25</span></h3>
									<h5 class="card-title text-center">Validados</h5>
									<p class="card-text">Cantidad de reactivos validados en la base de datos listos para ser usados en los cuestionarios.</p>
<!-- 									<div class="d-flex justify-content-end">
										<button class="btn btn-primary btn-sm">ver</button>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>