<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'header.php'; ?>
</head>
<body>
	<main class="container-fluid row" id="app">
		<section class="col col-md-3 p-4 " id="menu">
			<?php include 'menu.php'; ?>
		</section>
		<section class="col col-md-9 container mb-3 p-4 pt-3 border-start">
			<?php  $titulo_pagina = "Documentación del cliente";
			include 'menu_usuario.php'; ?>
			<div >{{ message }}</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const cliente = ref([])
			const servidor = '<?= $api ?>'
			const idCliente = ref(-1)

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				const idCliente = urlParams.get('id');

				axios.get(servidor+'clients/'+idCliente.value)
				.then(response=>{
					cliente.value = response.data					
				})
			})

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				cliente, idCliente,
				fechaLatam
			}
		}
	}).mount('#app')
</script>
</body>
</html>