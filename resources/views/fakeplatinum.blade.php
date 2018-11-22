@extends('layout.app')

@section('content')
    <style>
        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

	<div class="content">

        <br>
        <br>
        <br>

        <h1 class="title m-b-md">Platinum</h1>

        <br>
        <br>
        <br>

        <div class="row justify-content-center inputs">
			<div class="col-md-3 col-sm-12 inputs">
				<div class="card text-white bg-secondary">
					<div class="card-body">
						<h3 class="card-title text-center">Coordinador</h3>
                        <input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" placeholder="ID Coordinador">
                        <br>
                        <button type="submit" onclick="window.location.href='/coordinador'" class="btn btn-primary btn-block">Entrar</button>
					</div>
				</div>
			</div>

            <div class="col-md-3 col-sm-12 inputs">
				<div class="card text-white bg-secondary">
					<div class="card-body">
						<h3 class="card-title text-center">Profesor</h3>
                        <input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" placeholder="ID Profesor">
                        <br>
                        <button type="submit" onclick="window.location.href='/maestro'" class="btn btn-primary btn-block">Entrar</button>
					</div>
				</div>
			</div>

            <div class="col-md-3 col-sm-12 inputs">
				<div class="card text-white bg-secondary">
					<div class="card-body">
						<h3 class="card-title text-center">Alumno</h3>
                        <input type="number" class="form-control" onkeypress="return event.charCode >= 48" min="1" placeholder="Matricula">
                        <br>
                        <button type="submit" onclick="window.location.href='/alumno'" class="btn btn-primary btn-block">Entrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection