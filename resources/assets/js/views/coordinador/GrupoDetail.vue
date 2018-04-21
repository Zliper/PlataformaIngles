<template>
	<div class="container">
		<h3 class="display-4 titles">Detalles de grupo {{ grupoId }}</h3>

		<div class="d-flex justify-content-center mb-3 ">
			
		</div>
	</div>
</template>

<script>

export default {
	props: ['grupoId'],
	data() {
		return {
			data:{
				email: "root@gmail.com",
				password: "loremroot"
			},
		}
	},

	created() {
		 
	},

	methods:{
		 fetchAlumnos() {
			 
		 }
	}
}
</script>