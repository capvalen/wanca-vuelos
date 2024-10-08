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
			<?php  $titulo_pagina = "Detalle de paquete del cliente";
			include 'menu_usuario.php'; ?>

			<div class="card">
				<div class="card-body p-2">
				<label for=""><small>Datos del cliente</small></label>


					<div class="row">
						<div class="col-4">
							<label for="">Nombre</label>
							<p class="mb-0">Colegio Zárate</p>
						</div>
						<div class="col-4">
							<label for="">Registro</label>
							<p class="mb-0">01/06/2021</p>
						</div>
					</div>
				</div>
			</div>

			<div class="card my-3">
				<div class="card-body p-2">
					<div class="d-flex justify-content-between">
						<label for=""><small>Cuotas y fechas</small></label>
						<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar cuota</button>
					</div>
				</div>
			</div>
			
			<div class="card my-3">
				<div class="card-body p-2">
					<label for=""><small>Ciudades</small></label>
					<ol class="list-group list-group-numbered list-group-flush">
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
					<div class="row my-2">
						<div class="col-4 offset-md-2">
							<select name="" id="" class="form-select">
								<option value="1">Lima</option>
								<option value="2">Huancayo</option>
							</select>
						</div>
						<div class="col-4">
							<button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i> Agregar ciudad</button>
						</div>
					</div>
				</div>
			</div>

			<card class="card my-3">
				<div class="card-body p-2">
					<label for=""><small>Participantes</small></label>

				</div>
			</card>
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