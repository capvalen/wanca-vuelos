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
			<?php $titulo_pagina = "Sección Clientes";
			include 'menu_usuario.php'; ?>
			
			<div class="card mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> D.N.I. / R.U.C.</label>
							<input type="text" class="form-control" >
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Nombres / Razón social</label>
							<input type="text" class="form-control" >
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<a href="cliente-nuevo.php" class="btn btn-sm btn-outline-success"><i class="bi bi-asterisk"></i> Nuevo cliente</a>
				<button class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i> Filtrar</button>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref } = Vue

	createApp({
		setup() {
			const message = ref('Hello vue!')
			return {
				message
			}
		}
	}).mount('#app')
</script>
</body>
</html>