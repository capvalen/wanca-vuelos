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
			<?php  $titulo_pagina = "Configuraciones";
			include 'menu_usuario.php'; ?>
			<p>Seleccione de la lista de opciones que desea hacer</p>
			<div class="row">
				<div class="col col-md-5">
					<ul class="list-group">
						<a href="usuario-crear.php" class="list-group-item" :class="{ active: activeItem === 0 }" @mouseover="setActiveItem(0)" aria-current="true"><i class="bi bi-database"></i> Crear usuario</a>
						<li class="list-group-item" :class="{ active: activeItem === 1 }" @mouseover="setActiveItem(1)"><i class="bi bi-database"></i> Editar bancos</li>
					</ul>
				</div>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const message = ref('Hello vue!')
			const servidor = '<?= $api ?>'
			const activeItem = ref(0)

			const setActiveItem = (index) => {
				activeItem.value = index
			}

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				const idCliente = urlParams.get('id');

				axios.get(servidor+'clients/'+idCliente)
				.then(response=>{
					//
				})
			})

			return {
				message,
				activeItem,
				setActiveItem
			}
		}
	}).mount('#app')
</script>
</body>
</html>