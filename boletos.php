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
			<?php  $titulo_pagina = "Registro de Boletos";
			include 'menu_usuario.php'; ?>			

			<div class="card">
				<div class="card-body">
					<div class="row ">
						<div class="col col-md-4 mb-3">
							<label for="fecha_ida" class="form-label">Nombre del viaje</label>
							<input type="text" class="form-control" id="nombre" name="fecha_ida" required>
						</div>
						<div class="col col-md-4 mb-3">
							<label for="fecha_ida" class="form-label">Fecha de Ida</label>
							<input type="date" class="form-control" id="fecha_ida" name="fecha_ida" required>
						</div>
						<div class="col col-md-4 mb-3">
							<label for="fecha_vuelta" class="form-label">Fecha de Vuelta</label>
							<input type="date" class="form-control" id="fecha_vuelta" name="fecha_vuelta" required>
						</div>
					</div>
				</div>
			</div>


			<div class="card my-3">
				<div class="card-body">
					<p><strong>Cliente:</strong></p>
					<div class="row row-cols-3">
						<div class="col mb-3">
									<label for="fecha" class="form-label">Fecha</label>
									<input type="date" class="form-control" id="fecha_cliente" name="fecha" required>
							</div>
							<div class="col mb-3">
									<label for="usuario" class="form-label">Usuario</label>
									<input type="text" class="form-control" id="usuario" name="usuario" required>
							</div>
							<div class="col mb-3">
									<label for="num_boleto" class="form-label">N° Boleto</label>
									<input type="text" class="form-control" id="num_boleto" name="num_boleto" required>
							</div>
							<div class="col mb-3">
									<label for="pnr_mayorista" class="form-label">PNR Mayorista</label>
									<input type="text" class="form-control" id="pnr_mayorista" name="pnr_mayorista" required>
							</div>
							<div class="col mb-3">
									<label for="linea" class="form-label">Línea</label>
									<select name="sltLineas" id="" class="form-select">
										<option v-for="linea in lineas" :value="linea.id">{{ linea.aerolinea }}</option>
									</select>
							</div>
							<div class="col mb-3">
									<label for="pasajero" class="form-label">Pasajero</label>
									<input type="text" class="form-control" id="pasajero" name="pasajero" required>
							</div>
							<div class="col mb-3">
									<label for="precio_venta" class="form-label">Precio de Venta</label>
									<input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
							</div>
							<div class="col mb-3">
									<label for="precio_agencia" class="form-label">Precio de Agencia</label>
									<input type="number" step="0.01" class="form-control" id="precio_agencia" name="precio_agencia" required>
							</div>
							<div class="col mb-3">
									<label for="ganancia" class="form-label">Ganancia</label>
									<input type="number" step="0.01" class="form-control" id="ganancia" name="ganancia" required>
							</div>
							<div class="col mb-3">
									<label for="destino" class="form-label">Destino</label>
									<input type="text" class="form-control" id="destino" name="destino" required>
							</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-body my-3">
					<p><strong>Particular:</strong></p>
					<div class="row row-cols-3">
						<div class="col mb-3">
							<label for="dni" class="form-label">DNI</label>
							<input type="text" class="form-control" id="dni" name="dni" required>
						</div>
						<div class="col mb-3">
							<label for="nombres_apellidos" class="form-label">Nombres y Apellidos</label>
							<input type="text" class="form-control" id="nombres_apellidos" name="nombres_apellidos" required>
						</div>
						<div class="col mb-3">
							<label for="pnr_mayorista_cliente" class="form-label">PNR Mayorista</label>
							<input type="text" class="form-control" id="pnr_mayorista_cliente" name="pnr_mayorista_cliente" required>
						</div>
						<div class="col mb-3">
							<label for="linea_cliente" class="form-label">Línea</label>
							<select name="linea_cliente" id="linea_cliente" class="form-select">
								<option v-for="linea in lineas" :value="linea.id">{{ linea.aerolinea }}</option>
							</select>
						</div>
						<div class="col mb-3">
							<label for="ticket" class="form-label">Ticket</label>
							<input type="text" class="form-control" id="ticket" name="ticket" required>
						</div>
						<div class="col mb-3">
							<label for="costo" class="form-label">Costo</label>
							<input type="number" step="0.01" class="form-control" id="costo" name="costo" required>
						</div>
					</div>

					<p class="text-secondary">Tramos:</p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Tramo N°</th>
								<th>Fecha</th>
								<th>Ruta</th>
								<th>Hora Salida</th>
								<th>Hora Llegada</th>
								<th>N° Vuelo</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>15/07/2023</td>
								<td>Lima - Madrid</td>
								<td>08:45</td>
								<td>15:30</td>
								<td>IB6650</td>
							</tr>
							<tr>
								<td>2</td>
								<td>22/07/2023</td>
								<td>Madrid - Barcelona</td>
								<td>10:15</td>
								<td>11:30</td>
								<td>IB1234</td>
							</tr>
							<tr>
								<td>3</td>
								<td>29/07/2023</td>
								<td>Barcelona - Lima</td>
								<td>13:20</td>
								<td>21:45</td>
								<td>IB6651</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const lineas = ref([])

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				const idCliente = urlParams.get('id');

				axios.get(servidor+'clients/'+idCliente)
				.then(response=>{
					//
				})
				axios.get(servidor+'lineas').then(response=> lineas.value = response.data)
			})

			return {
				lineas
			}
		}
	}).mount('#app')
</script>
<style>
	.form-control, .form-select{
		margin-bottom: 0px;
	}
</style>
</body>
</html>