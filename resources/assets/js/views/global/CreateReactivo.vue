<template>
	<div>
		<h3 class="titles">Reactivos</h3>
		<hr>

		<div>
			<form >
				<div class="form-group row justify-content-sm-center">
					<div class="col-8 mb-4">
						<label for="catalogo">Destino del reactivo</label>
						<select id="catalogo" class="form-control">
							<option selected>Elije el destino del reactivo</option>
							<option value="ingles1">Para practicas</option>
							<option value="ingles2">Para examen ordinario</option>
							<option value="ingles4">Para examen de recuperacion</option>
							<option value="ingles4">Para examen de extraordinario</option>
						</select>
					</div>
				</div>

				<div class="form-group row justify-content-md-center">
					<div class="col-8 mb-4">
						<label for="materia">Punto Gramatical</label>
						<select name="materia" id="materia" class="form-control">
							<option selected></option>
							<option value="ingles1">8.1.2 Tema uno</option>
							<option value="ingles2">8.1.2 Tema uno</option>
							<option value="ingles4">8.1.2 Tema uno</option>
						</select>
					</div>
					<div class="col-4 mb-4">
						<label for="Unidad">Unidad</label>
						<select name="Unidad" id="Unidad" class="form-control">
							<option selected></option>
							<option value="unidad1">Unidad 1</option>
							<option value="unidad2">Unidad 2</option>
							<option value="unidad3">Unidad 3</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row justify-content-center">
					<br>
					<h6>Elije la competencia al cual seran asignados los reactivos y el numero de ellos</h6>
				</div>
				
				<div class="form-group row justify-content-center ">
					<div class="col-3">
						<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
							<div class="card-header">
								<label class="form-check-label">
									<input type="radio" name="competencia" id="eading" value="reading"> Reading
								</label>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center">
									<img src="" width="50" height="50" alt="rounded">
									<br>
									Reading
								</h5>
								<p class="card-text"><small></small></p>
							</div>
							<div class="card-footer">
								<div class="input-group mb-3">
									<input  type="text" class="form-control" placeholder="# Reactivos">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">Confirmar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3">
						<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
							<div class="card-header">
								<label class="form-check-label">
									<input type="radio" name="competencia" id="listening" value="listening"> Listening
								</label>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center">
									<img src="img/ico_listening.png" width="50" height="50" alt="rounded">
									<br>
									Listening
								</h5>
								<p class="card-text"></p>
							</div>
							<div class="card-footer">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="# Reactivos">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">Confirmar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-3">
						<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
							<div class="card-header">
								<label class="form-check-label">
									<input type="radio" name="competencia" id="grammar" value="grammar"> Grammar
								</label>
							</div>
							<div class="card-body">
								<h5 class="card-title text-center">
									<img src="img/ico_grammar.png" width="50" height="50" alt="rounded">
									<br>
									Grammar
								</h5>
								<p class="card-text"></p>
							</div>
							<div class="card-footer">
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="# Reactivos">
									<div class="input-group-append">
										<button class="btn btn-primary" type="button">Confirmar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group row justify-content-center ">
					<!-- URL -->
					<div class="col-8">
						<div class="alert alert-primary alert-dismissible fade show" role="alert">
							<strong>Hola!</strong><br>De ser necesario asigna un archivo de apoyo para que el alumno pueda responder el reactivo.
							Asignado una URL en el cuadro de texto de abajo.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<h6>URL</h6>
						<div class="input-group mb-5">

							<input type="text" class="form-control" placeholder="Ingresa el enlace del archivo">
							<div class="input-group-append ">
								<button class="btn btn-primary" type="button">Agregar</button>
							</div>
						</div>

					</div>
					<!-- Tipo de reactivo -->
					<div class="col-8 mb-4">
						<label for="materia">Tipo de reactivo</label>
						<select name="materia" id="materia" class="form-control mb-4">
							<option selected>Elije el tipo del reactivo</option>
							<option value="ingles1">Preguntas abiertas</option>
							<option value="ingles2">Preguntas cerradas</option>
							<option value="ingles4">Preguntas de complementar</option>
							<option value="ingles4">Relacion de columna</option>
							<option value="ingles4">Falso y verdadero</option>
						</select>
					</div>
				</div>

				<h3>Reactivos</h3>
				<hr>
			</form>
		</div>
	</div>
</template>

<script>

export default {
	data() {
		return {
			cuestionarios: [],
			puntos: [],
		}
	},
	created() {

	},

	methods: {
		fetchCatalogo() {
			axios.get('/api/cuestionarios')
			.then(response => {
				this.cuestionarios = response.data.catalogo;
			})
			.catch(e=>{
				console.log(e);
			});
		},

		fetchPuntosGramaticales() {
			axios.get('/api/puntos')
			.then(response => {
				this.puntos = response.data.puntos;
			})
			.catch(e => {
				console.log(e);
			});
		}
	}
}
</script>