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
			<?php  $titulo_pagina = "Nuevo provedor";
			include 'menu_usuario.php'; ?>
			<div class="card my-2">
				<div class="card-body">
					<label for=""><small>Datos generales</small></label>
					<div class="row">
						<div class="col-md-4">
							<label for="">Ciudad</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Lima</option>
								<option value="2">Huancayo</option>
								<option value="3">La merced</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Servicios</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Restaurant</option>
								<option value="2">Hotel</option>
								<option value="3">La merced</option>
								<option value="4">Transporte interprovincial</option>
								<option value="5">Transporte turístico</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Fecha inicio</label>
							<input type="date" class="form-control" autocomplete="off" value="2024-10-04">
						</div>
						<div class="col-md-4">
							<label for="">Fecha final</label>
							<input type="date" class="form-control" autocomplete="off" value="2024-10-04">
						</div>
						<div class="col-md-4">
							<label for="">Concepto</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Alojamiento</option>
								<option value="2">Desayuno</option>
								<option value="3">Almuerzo</option>
								<option value="4">Cena</option>
								<option value="5">Ruta de transporte terrestre</option>
								<option value="6">Ruta de transporte turístico</option>
								<option value="6">Ruta de transporte aéreo</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Dato extra:</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
					</div>
					
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg"><i class="bi bi-asterisk"></i> Crear proveedor</button>
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