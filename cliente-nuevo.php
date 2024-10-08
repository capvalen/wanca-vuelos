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
			<?php  $titulo_pagina = "Registro de cliente nuevo";
			include 'menu_usuario.php'; ?>
			<div class="row">
				<div class="col-6">
					<label for="">Nombre del cliente</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<label for=""><small>Indicar ciudades</small></label>
					<div class="row">
						<div class="col">
							<label for="">Ciudad</label>
							<select name="" id="" class="form-select">
								<option value="1">Lima</option>
								<option value="2">Huancayo</option>
							</select>
						</div>
						<div class="col d-flex align-items-center">
							<button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i> Agregar ciudad</button>
						</div>
					</div>

					<ol class="list-group list-group-numbered">
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>La merced</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>San Ramón</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>Huancayo</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
					</ol>
				</div>

				<div class="d-flex mt-2 justify-content-center">
					<button class="btn btn-primary"><i class="bi bi-floppy"></i> Guardar cliente</button>
				</div>
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