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
			<?php  $titulo_pagina = "Aportaciones";
			include 'menu_usuario.php'; ?>
		
			<label for=""><small>Datos del paquete</small></label>
			<div class="row">
				<div class="col">
					<label for="">Cliente</label>
					<p>Colegio La asunción</p>
				</div>
				<div class="col">
					<label for="">Paquete</label>
					<p>Tour Selvático 2 noches</p>
				</div>
				<div class="col">
					<label for="">Costo</label>
					<p>S/ 2500.00</p>
				</div>
				<div class="col">
					<label for="">Descuento</label>
					<p>S/ 500.00</p>
				</div>
				<div class="col">
					<label for="">Pago final</label>
					<p>S/ 2000.00</p>
				</div>
			</div>

			<label for=""><small>Fechas de viaje</small></label>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Salida el día</th>
					<th>Desde</th>
					<th>Llegada</th>
					<th>Ciudad</th>
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

			<label for=""><small>Cuotas y fechas</small></label>
		<table class="table table-hover">
			<thead>
				<th>N°</th>
				<th>Monto (S/)</th>
				<th>Desde</th>
				<th>Hasta</th>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>S/ 500.00</td>
					<td>2024-10-01</td>
					<td>2024-10-28</td>
				</tr>
				<tr>
					<td>2</td>
					<td>S/ 1500.00</td>
					<td>2024-10-29</td>
					<td>2024-11-15</td>
				</tr>
			</tbody>
		</table>

		<div class="card my-2">
			<div class="card-body">
				<label for=""><small>Agregar aportación</small></label>
				<div class="row">
					<div class="col-md-4">
						<label for="">Tipo de participante</label>
						<select class="form-select" v-model="paquete.tipoParticipante">
							<option value="1">Personal</option>
							<option value="2">Como Junta directiva</option>
						</select>
					</div>
					<div class="col-md-4" v-show="paquete.tipoParticipante==1">
						<label for="">D.N.I. del participante</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-4" v-show="paquete.tipoParticipante==1">
						<label for="">Nombre participante</label>
						<p>Carlos Alex Pariona Valencia</p>
					</div>
					<div class="col-md-4">
						<label for="">Monto</label>
						<input type="number" class="form-control">
					</div>
					<div class="col-md-4">
						<label for="">Tipo de moneda</label>
						<select class="form-select" v-model="paquete.moneda">
							<option value="1">Soles</option>
							<option value="2">Dólares</option>
						</select>
					</div>
					<div class="col-md-4" v-show="paquete.moneda==2">
						<label for="">Tipo de cambio</label>
						<input type="number" class="form-control">
					</div>
					<div class="col-md-12">
						<label for="">Concepto de pago</label>
						<select class="form-select" id="">
							<option value="1">Actividades adicionales por caret</option>
							<option value="2">Pago de cuota de viaje contratado por mí y por la junta directiva</option>
							<option value="3">Adelanto para viaje contratado por mí y por la junta directiva</option>
							<option value="4">Adelanto de pago de Junta directiva para viaje contrado del cliente</option>
						</select>
					</div>
					<div class="col-md-12">
						<label for="">Datos adicionales</label>
						<input type="text" class="form-control">
					</div>
					<div class="col-md-4">
						<label for="">Depósito a cuenta</label>
						<select name="" id="" class="form-select" v-model="paquete.aCuenta">
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</div>
					<div class="col-md-4" v-show="paquete.aCuenta">
						<label for="">Banco</label>
						<select name="" id="" class="form-select">
							<option value="1">BCP</option>
							<option value="2">Scotiabank</option>
							<option value="3">BBVA</option>
						</select>
					</div>
					<div class="col-md-4" v-show="paquete.aCuenta">
						<label for="">Titular de la cuenta</label>
						<p>Nery C.</p>
					</div>
					<div class="col-md-4" v-show="paquete.aCuenta">
						<label for="">Fecha de depósito</label>
						<input type="date" class="form-control">
					</div>
					<div class="col-md-4" v-show="paquete.aCuenta">
						<label for="">N° de operación</label>
						<input type="text" class="form-control">
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-end">
			<button class="btn btn-outline-success"><i class="bi bi-box-arrow-in-down"></i> Adicionar pago</button>
		</div>

		<div class="card my-2">
			<div class="card-body">
				<label for=""><small>Aportaciones realizadas</small></label>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>Aportante</th>
						<th>Fecha</th>
						<th>Monto pagado</th>
						<th>Tipo de cambio</th>
						<th>Monto en Soles</th>
						<th>Concepto</th>
						<th>@</th>
					</thead>
					<tbody>
						<tr>
								<td>1</td>
								<td>Junta directiva</td>
								<td>09/10/2024</td>
								<td>$100</td>
								<td>3.9</td>
								<td>S/ 390</td>
								<td>Cuota</td>
								<td>
										<button class="btn btn-sm me-1 btn-outline-secondary" title="Comprobante de pago"><i class="bi bi-sticky"></i></button>
										<button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-eraser"></i></button>
								</td>
						</tr>
						<tr>
								<td>2</td>
								<td>María Rodríguez</td>
								<td>11/08/2024</td>
								<td>$50</td>
								<td>4.2</td>
								<td>S/ 210</td>
								<td>Adelanto</td>
								<td>
										<button class="btn btn-sm me-1 btn-outline-secondary" title="Comprobante de pago"><i class="bi bi-sticky"></i></button>
										<button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-eraser"></i></button>
								</td>
						</tr>
						<tr>
								<td>3</td>
								<td>Junta directiva</td>
								<td>11/08/2024</td>
								<td>S/ 150</td>
								<td>-</td>
								<td>S/ 103</td>
								<td>Adelanto</td>
								<td>
										<button class="btn btn-sm me-1 btn-outline-secondary" title="Comprobante de pago"><i class="bi bi-sticky"></i></button>
										<button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-eraser"></i></button>
								</td>
						</tr>
						<tr>
								<td>4</td>
								<td>Junta directiva</td>
								<td>10/08/2024</td>
								<td>S/ 200</td>
								<td>-</td>
								<td>S/ 200</td>
								<td>Cuota</td>
								<td>
										<button class="btn btn-sm me-1 btn-outline-secondary" title="Comprobante de pago"><i class="bi bi-sticky"></i></button>
										<button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-eraser"></i></button>
								</td>
						</tr>
						<tr>
								<td>5</td>
								<td>Carlos Martínez</td>
								<td>09/05/2024</td>
								<td>$80</td>
								<td>4.3</td>
								<td>S/ 344</td>
								<td>Adelanto</td>
								<td>
										<button class="btn btn-sm me-1 btn-outline-secondary" title="Comprobante de pago"><i class="bi bi-sticky"></i></button>
										<button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="bi bi-eraser"></i></button>
								</td>
						</tr>
					</tbody>
					<tfoot>
						<td colspan="5" class="text-end fw-bold">Total recaudado</td>
						<td class="fw-bold">S/ 1247</td>
					</tfoot>
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
			const paquete = ref({
				tipoParticipante:1,
				moneda: 1, aCuenta:0
			})
			return {
				message, paquete
			}
		}
	}).mount('#app')
</script>
</body>
</html>