<template>
	<div>
		<h3 class="titles">Puntos Gramaticales</h3>
		<hr>

		<div class="d-flex justify-content-center mb-3 ">
			<form class="form-inline">
				<div class="form-group">
					<label class="filters" for="unidad">Unidad</label>
					<input class="form-control" type="text" id="unidad" placeholder="Unidad">
				</div>

				<div class="form-group">
					<label class="filters" for="tema">Punto Gramatical</label>
					<input class="form-control" id="tema" type="text">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Agregar</button>
				</div>
			</form>
		</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>
								Unidad
							</th>
							<th>
								Punto Gramatical
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</template>