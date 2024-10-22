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
			<?php  $titulo_pagina = "Detalle de liberado";
			include 'menu_usuario.php'; ?>
			<div class="card">
				<div class="card-body">
					<label for=""><small>Datos personales</small></label>
					<div class="row">
						<div class="col-md-4">
							<label for="">Apellidos</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
						<div class="col-md-4">
							<label for="">Nombres</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
						<div class="col-md-4">
							<label for="">Relación con los participantes</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Padre de familia</option>
								<option value="2">Apoderado</option>
								<option value="3">Director</option>
								<option value="5">Sub-Director</option>
								<option value="6">Docente</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset">
							<label for="">D.N.I.</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
						<div class="col-md-4 offset">
							<label for="">Fecha caducidad DNI</label>
							<input type="date" class="form-control" autocomplete="off">
						</div>
						<div class="col-md-4 ">
							<label for="">Celular</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
						<div class="col-md-12">
							<label for="">Dirección de domicilio actual</label>
							<input type="text" class="form-control" autocomplete="off">
						</div>
					</div>
				</div>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<label for=""><small>Datos de adicionales</small></label>
					<div class="row">
						<div class="col-md-4 ">
							<label for="">Ficha de inscripción</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
							<p class=""><i class="bi bi-arrow-right"></i> Entregado 25/10/2023</p>
						</div>
						<div class="col-md-4 ">
							<label for="">Acuerdo de pago firmado</label>
							<select name="" id="" class="form-select mb-0">
								<option value="1">Si</option>
								<option value="0" select>No</option>
							</select>
							<p class=""><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg"><i class="bi bi-arrow-clockwise"></i> Actualizar datos</button>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<p><strong>Lista de Tours asociados al liberado</strong></p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Tour</th>
							<th>Entidad</th>
							<th>Fecha</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Visita guiada a museo</td>
								<td>Colegio Santa Rosa</td>
								<td>14/05/2025</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Tour selvático</td>
								<td>Comitiva San Jose</td>
								<td>06/01/2024</td>
								</tr>
						</tbody>

					</table>
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