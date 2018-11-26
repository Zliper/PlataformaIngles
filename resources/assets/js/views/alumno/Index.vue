<template>
	<div class="container mt-5">
		<div class="row">
			<div class="col">
				<h3 class="display-4 titles">Bienvenido </h3>
				<hr>
				<div class="jumbotron">
					<h4 class="display-4">Panel Alumno </h4>
					<p class="lead">En esta area encontraras tarjetas con algunas notificaciones y datos que quizas puedan servirte.</p>

					<div class="row justify-content-center">
						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">
									Actividades
								</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge" v-bind:class="badgeAct"> {{ actividades }} </span></h3>
									<h5 class="card-title text-center">Actividades por realizar</h5>
									<p class="card-text">Actividades activas para realizar.</p>
								</div>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="card text-white bg-secondary mb-3">
								<div class="card-header">Examenes</div>
								<div class="card-body">
									<h3 class="text-center"><span class="badge" v-bind:class="badgeEx"> {{ examenes }} </span></h3>
									<h5 class="card-title text-center">Examenes pendientes</h5>
									<p class="card-text">Examenes activos aun no presentados</p>
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
      actividades: 0,
      examenes: 0,
      badgeAct: "badge-success",
      badgeEx: "badge-success"
    };
  },

  created() {
    this.fetchActividades();
    this.fetchExamenes();
  },

  methods: {
    fetchActividades() {
      axios
        .get("/api/difusiones?count=actividades&matricula=1&status=2")
        .then(response => {
          this.actividades = response.data;
          if (response.data > 0) {
            this.badgeAct = "badge-warning";
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    fetchExamenes() {
      axios
        .get("/api/difusiones?count=ordinarios&matricula=1&status=2")
        .then(response => {
          this.examenes = response.data;
          if (response.data > 0) {
            this.badgeEx = "badge-warning";
          }
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>