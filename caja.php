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
			<?php  $titulo_pagina = "Caja";
			include 'menu_usuario.php'; ?>
			
			<div v-if="caja.estado=='cerrada'">
				<p>No hay ninguna caja aperturada actualmente</p>
				<button class="btn btn-outline-secondary rounded-pill"><i class="bi bi-piggy-bank"></i> Aperturar nueva caja</button>
				<hr>
			</div>

			<div class="row" >
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><strong>Resumen de cuadre <span v-if="caja.estado=='abierta'">actual</span> <span caja.estado=='cerrada'>de la última caja</span></strong></p>
							<div class="row">
								<div class="col-6 d-flex justify-content-center align-items-center flex-column">
									<label>Fecha de apertura</label>
									<p class="text-secondary">{{fechaLatamLarga(caja.fecha_apertura)}}</p>
								</div>
								<div class="col-6 d-flex justify-content-center align-items-center flex-column">
									<label>Fecha de cierre</label>
									<p class="text-secondary" v-if="caja.estado=='cerrada'">{{fechaLatamLarga(caja.fecha_cierre) ?? '-'}}</p>
									<p class="text-secondary" v-if="caja.estado=='abierta'">Caja activa</p>
								</div>
							</div>
							<div class="row row-cols-2 row-cols-md-4">
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Apertura</label>
									<p class="text-secondary"><strong>S/ {{caja.inicial}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Ingresos Totales</label>
									<p class="text-secondary mb-0"><strong>S/ {{caja.monto_ingresos_soles}}</strong></p>
									<p class="text-secondary mb-0"><strong>$ {{caja.monto_ingresos_dolares}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Salidas Totales</label>
									<p class="text-secondary mb-0"><strong>S/ {{caja.monto_salida_soles}}</strong></p>
									<p class="text-secondary mb-0"><strong>$ {{caja.monto_salida_dolares}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Total en caja</label>
									<p class="text-secondary mb-0"><strong>S/ {{parseFloat(caja.monto_ingresos_soles - caja.monto_salida_soles).toFixed(2) }}</strong></p>
									<p class="text-secondary mb-0"><strong>$/ {{parseFloat(caja.monto_ingresos_dolares - caja.monto_salida_dolares).toFixed(2) }}</strong></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-12 col-md-6">
					<button class="btn btn-outline-primary rounded-pill" v-if="caja.estado=='abierta'"><i class="bi bi-plus-circle"></i> Nuevo ingreso</button>
					<table class="table table-hover my-3" id="positiva">
						<thead>
							<tr class="table-primary">
								<th>N°</th>
								<th>Ingresos</th>
								<th title="Moneda"><i class="bi bi-receipt"></i></th>
								<th>Monto</th>
							</tr>
						</thead>
						<tbody>
							<tr class="puntero" v-for="movimiento in movimientos" v-if="movimiento.">
								<td>1</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/pos.jpg" alt=""></span>
								</td>
								<td>S/ 50.00</td>
							</tr>
							<tr class="puntero">
								<td>1</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/efectivo.jpg" alt=""></span>
								</td>
								<td>S/ 50.00</td>
							</tr>
							<tr class="puntero">
								<td>1</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/yape-color.webp" alt=""></span>
								</td>
								<td>S/ 50.00</td>
							</tr>
							<tr class="puntero">
								<td>1</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/plin.png" alt=""></span>
								</td>
								<td>S/ 50.00</td>
							</tr>
						</tbody>

					</table>
				</div>
				<div class="col-12 col-md-6">
				
				<button class="btn btn-outline-danger rounded-pill" v-if="caja.estado=='abierta'"><i class="bi bi-dash-circle"></i> Nueva salida</button>
					<table class="table table-hover my-3" id="negativa">
						<thead>
							<tr class="table-danger">
								<th>N°</th>
								<th>Salidas</th>
								<th title="Moneda"><i class="bi bi-receipt"></i></th>
								<th>Monto</th>
							</tr>
						</thead>
						<tbody>
							<tr class="puntero">
								<td>1</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/yape-color.webp" alt=""></span>
								</td>
								<td>S/ 50.00</td>
							</tr>
							<tr class="puntero">
								<td>2</td>
								<td>Apertura</td>
								<td class="moneda">
									<span><img src="img/yape-color.webp" alt=""></span>
								</td>

								<td>S/ 50.00</td>
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
			const idCaja = ref(-1)
			const caja = ref([])
			const movimientos = ref([])

			onMounted(()=>{
				axios.get(servidor+'ultimaCaja/')
				.then(response=>{
					caja.value = response.data
				})
			})

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}
			function fechaLatamLarga(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY h:mm a');
			}

			return {
				idCaja, caja, movimientos,
				fechaLatam, fechaLatamLarga
			}
		}
	}).mount('#app')
</script>
<style scoped>
	.table-primary{
		--bs-table-color: #fff;
  	--bs-table-bg: #0b6bff;
	}
	.table-danger{
		--bs-table-color: #fff;
  	--bs-table-bg: #ff192e;
	}
	#positiva td{ color: #172c80;}
	#negativa td{ color:rgb(112, 1, 13);}
	.puntero{cursor:pointer}
	.moneda img{width: 30px; height: 30px;}
</style>
</body>
</html>