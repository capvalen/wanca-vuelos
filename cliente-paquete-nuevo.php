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
			<?php $titulo_pagina= "Registro de paquete de cliente";
			include 'menu_usuario.php'; ?>

			<div class="row">
				<div class="col-6">
					<label for="">Nombre del cliente</label>
					<input type="text" class="form-control">
				</div>
				<div class="col-6">
					<label for="">Destino</label>
					<select name="" id="" class="form-select">
						<option value="1">Lima</option>
						<option value="2">Huancayo</option>
					</select>
				</div>
				<div class="col-6">
					<label for="">Costo del paquete</label>
					<input type="number" class="form-control" value=0>
				</div>
				<div class="col-6">
					<label for="">Moneda</label>
					<select name="" id="" class="form-select">
						<option value="1">Soles</option>
						<option value="2">Dólares</option>
					</select>
				</div>
				
				<div class="col-12">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Cuotas y fechas</small></label>
								<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar cuota</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Monto (S/)</th>
									<th>Desde</th>
									<th>Hasta</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><input type="number" class="form-control" value="50.00"></td>
										<td><input type="date" class="form-control" value="2024-10-01"></td>
										<td><input type="date" class="form-control" value="2024-10-28"></td>
										<td>
											<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td><input type="number" class="form-control" value="50.00"></td>
										<td><input type="date" class="form-control" value="2024-10-29"></td>
										<td><input type="date" class="form-control" value="2024-11-15"></td>
										<td>
											<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Fechas de viaje</small></label>
								<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar destino</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Salida el día</th>
									<th>Desde</th>
									<th>Llegada</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>04/05/2025</td>
										<td>Huancayo</td>
										<td>05/05/2025</td>
										<td>Lima</td>
									</tr>
									<tr>
										<td>2</td>
										<td>06/05/2025</td>
										<td>Lima</td>
										<td>06/05/2025</td>
										<td>Cuzco</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Datos de los participantes</small></label>
								<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar participantes</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>D.N.I.</th>
									<th>Nombre y apellidos</th>
									<th>N° Pasaporte</th>
									<th>Celular</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>12345678</td>
										<td>Juan Pérez</td>
										<td>AB123456</td>
										<td>987654321</td>
									</tr>
									<tr>
										<td>2</td>
										<td>87654321</td>
										<td>María Rodríguez</td>
										<td>CD123456</td>
										<td>987654321</td>
									</tr>
									<tr>
										<td>3</td>
										<td>45678901</td>
										<td>Luis Gómez</td>
										<td>EF123456</td>
										<td>987654321</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Datos del proveedor</small></label>
								<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar proveedor</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Proveedor</th>
									<th>Lugar</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Restaurant El Chancho Feliz</td>
										<td>Ayacucho</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Hotel El Dorado</td>
										<td>Ayacucho</td>
									</tr>
									<tr>
										<td>3</td>
										<td>Restaurante Don Pepe</td>
										<td>Cusco</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Liberados</small></label>
								<button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg"></i> Agregar liberado</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Nombre y apellidos</th>
									<th>D.N.I.</th>
									<th>Celular</th>
									<th>Parentezco</th>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Juan Pérez</td>
										<td>12345678</td>
										<td>950660005</td>
										<td>Padre de familia</td>
									</tr>
									<tr>
										<td>2</td>
										<td>María Rodríguez</td>
										<td>87654321</td>
										<td>948184004</td>
										<td>Sub-Director</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-6 mt-2">
					<label for="">Costo adicional del paquete (S/)</label>
					<input type="number" class="form-control">
				</div>
				<div class="col-6 mt-2">
					<label for="">Motivo del costo adicional</label>
					<input type="text" class="form-control">
				</div>
				<div class="col-6">
					<p class="fs-5">Total a pagar final: <strong>S/ 6 000.00</strong></p>
				</div>
				<div class="col-6 d-grid">
					<button class="btn btn-success"><i class="bi bi-floppy"></i> Guardar cliente</button>
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
<style>
	
</style>
</body>
</html>