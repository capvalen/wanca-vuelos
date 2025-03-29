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
				<button class="btn btn-outline-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalAperturar"><i class="bi bi-piggy-bank"></i> Aperturar nueva caja</button>
				<hr>
			</div>

			<div class="row" >
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><strong>Resumen de cuadre <span v-if="caja.estado=='abierta'">actual</span> <span v-if="caja.estado=='cerrada'">de la última caja</span></strong></p>
							<div class="row">
								<div class="col-6 d-flex justify-content-center align-items-center flex-column">
									<label>Fecha de apertura</label>
									<p class="text-secondary">{{fechaLatamLarga(caja.fecha_apertura)}}</p>
								</div>
								<div class="col-6 d-flex justify-content-center align-items-center flex-column">
									<label>Fecha de cierre</label>
									<p class="text-secondary" v-if="caja.estado=='cerrada'">{{fechaLatamLarga(caja.fecha_cierre) ?? '-'}}</p>
									<p class="text-secondary mb-0" v-if="caja.estado=='abierta'">✔ Caja activa</p>
									<button class="btn btn-outline-success btn-sm" v-if="caja.estado=='abierta'" @click="cerrarCaja()"><i class="bi bi-piggy-bank"></i> Cerrar caja</button>
								</div>
							</div>
							<div class="row row-cols-2 row-cols-md-4">
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Apertura</label>
									<p class="text-secondary"><strong>S/ {{caja.inicial}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Ingresos Totales</label>
									<p class="text-secondary mb-0"><strong>S/ {{parseFloat(sumaIngresosC.soles).toFixed(2)}}</strong></p>
									<p class="text-secondary mb-0"><strong>$ {{parseFloat(sumaIngresosC.dolares).toFixed(2)}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Salidas Totales</label>
									<p class="text-secondary mb-0"><strong>S/ {{parseFloat(sumaEgresosC.soles).toFixed(2)}}</strong></p>
									<p class="text-secondary mb-0"><strong>$ {{parseFloat(sumaEgresosC.dolares).toFixed(2)}}</strong></p>
								</div>
								<div class="col d-flex justify-content-center align-items-center flex-column">
									<label class="text-secondary">Total en caja</label>
									<p class="text-secondary mb-0"><strong>S/ {{parseFloat(sumaIngresosC.soles - sumaEgresosC.soles).toFixed(2) }}</strong></p>
									<p class="text-secondary mb-0"><strong>$/ {{parseFloat(sumaIngresosC.dolares - sumaEgresosC.dolares).toFixed(2) }}</strong></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-12 col-md-6">
					<button class="btn btn-outline-primary rounded-pill" v-if="caja.estado=='abierta'" data-bs-toggle="modal" data-bs-target="#modalIngreso"><i class="bi bi-plus-circle"></i> Nuevo ingreso</button>
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
							<template v-for="(movimiento, index) in mIngresos" >
								<tr class="puntero" v-if="movimiento.proceso_id!=2" data-bs-toggle="modal" data-bs-target="#detallesIngreso" @click="detallesIngreso(index)">
									<td>{{index+1}}</td>
									<td class="text-capitalize">
										<span v-if="[1,10].includes(movimiento.proceso_id)">{{movimiento.observaciones}}</span>
										<span v-else>{{movimiento.proceso_nombre}}</span>
									</td>
									<td v-if="movimiento.banco_id==1">Efectivo</td>
									<td v-else :title="movimiento.cuenta">{{movimiento.nombre_banco }}</td>
									<td>
										<span v-if="movimiento.moneda_id==1">S/</span>
										<span v-else>$</span>
										 {{movimiento.monto}}</td>
								</tr>
							</template>
						</tbody>

					</table>
				</div>
				<div class="col-12 col-md-6">
				
				<button class="btn btn-outline-danger rounded-pill" v-if="caja.estado=='abierta'" data-bs-toggle="modal" data-bs-target="#modalSalida"><i class="bi bi-dash-circle"></i> Nueva salida</button>
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
							<template v-for="(movimiento, index) in mSalidas" >
								<tr class="puntero" v-if="movimiento.proceso_id==2" data-bs-toggle="modal" data-bs-target="#detallesSalida" @click="detallesSalida(index)">
									<td>{{index+1}}</td>
									<td class="text-capitalize">
										<span>{{movimiento.observaciones}}</span>
									</td>
									<td v-if="movimiento.banco_id==1">Efectivo</td>
									<td v-else :title="movimiento.cuenta">{{movimiento.nombre_banco }}</td>
									<td>
										<span v-if="movimiento.moneda_id==1">S/</span>
										<span v-else>$</span>
										 {{movimiento.monto}}</td>
								</tr>
							</template>
						</tbody>
					</table>
				</div>
			</div>

		</section>
		<section>
			<!-- Modal -->
			<div class="modal fade" id="modalAperturar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Aperturar</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p>Para aperturar ingrese el monto con el que comienza el turno</p>
							<div class="mb-3">
								<label for="monto" class="form-label">Monto de apertura</label>
								<input type="number" class="form-control" id="monto" placeholder="0.00" v-model="apertura.apertura">
								<label for="monto" class="form-label">¿Alguna observación?</label>
								<input type="text" class="form-control" id="obs" v-model="apertura.observaciones">
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-secondary" @click="aperturarCaja()" data-bs-dismiss="modal">Aperturar</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalIngreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar ingreso</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="monto" class="form-label">Monto de ingreso de dinero (S/)</label>
								<input type="number" class="form-control" id="monto" placeholder="0.00" v-model="apertura.apertura">
								<label for="monto" class="form-label">Moneda</label>
								<select name="" id="" class="form-select" v-model="apertura.moneda_id">
									<option value="1">Soles</option>
									<option value="2">Dolares</option>
								</select>
								<label for="monto" class="form-label">Motivo del ingreso</label>
								<input type="text" class="form-control" id="obs" v-model="apertura.observaciones">
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-primary" @click="ingresoACaja()" data-bs-dismiss="modal">Agregar ingreso</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalSalida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Salida</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<label for="monto" class="form-label">Monto de salida de dinero (S/)</label>
								<input type="number" class="form-control" id="monto" placeholder="0.00" v-model="apertura.apertura">
								<label for="monto" class="form-label">Moneda</label>
								<select name="" id="" class="form-select" v-model="apertura.moneda_id">
									<option value="1">Soles</option>
									<option value="2">Dolares</option>
								</select>
								<label for="monto" class="form-label">Motivo de la salida</label>
								<input type="text" class="form-control" id="obs" v-model="apertura.observaciones">
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-danger" @click="salidaACaja()" data-bs-dismiss="modal">Agregar salida</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="detallesIngreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Detalles</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								
								<label for="monto" class="form-label">Fecha de creación</label>
								<p>{{fechaLatamLarga(detalles.created_at)}}</p>
								<label for="monto" class="form-label">Proceso</label>
								<p>{{detalles.proceso_nombre}}</p>
								<label for="monto" class="form-label">Monto</label>
								<p>{{detalles.monto}}</p>
								<label for="monto" class="form-label">Moneda</label>
								<select name="" id="" class="form-select" v-model="detalles.moneda_id">
									<option value="1">Soles</option>
									<option value="2">Dolares</option>
								</select>
								<label class="form-label">Banco</label>
								<select name="" id="" class="form-select" v-model="detalles.banco_id">
									<option v-for="banco in bancos" :value="banco.id">{{banco.entidad}}</option>
								</select>
								<label class="form-label">N° de operación</label>
								<input type="text" class="form-control" id="operacion"  v-model="detalles.num_operacion">
								<label class="form-label">Fecha de depósito</label>
								<input type="date" class="form-control" id="operacion"  v-model="detalles.fecha_deposito">
								<label class="form-label">Cuenta</label>
								<select name="" id="" class="form-select" v-model="detalles.cuenta">
									<option value="Nery">Nery</option>
									<option value="Tradition">Tradition</option>
									<option value="Christian">Christian</option>
								</select>
								<label for="monto" class="form-label">Tipo de cambio</label>
								<input type="number" class="form-control" id="monto" placeholder="0.00" v-model="detalles.tipo_cambio">
								<label for="monto" class="form-label">Paquete</label>
								<p>{{detalles.nombre_paquete || '-'}}</p>
								<label for="monto" class="form-label">Tipo de participante</label>
								<p>{{detalles.tipo_participante}}</p>
								<label for="monto" class="form-label">Participante</label>
								<p>{{detalles.nombre_participante || '-'}}</p>
								<label for="monto" class="form-label">Observaciones, datos extras</label>
								<input type="text" class="form-control" id="obs" v-model="detalles.observaciones">
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-primary" @click="actualizarIngreso()" data-bs-dismiss="modal">Actualizar ingreso</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="detallesSalida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Detalles</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								
								<label for="monto" class="form-label">Fecha de creación</label>
								<p>{{fechaLatamLarga(detalles.created_at)}}</p>
								<label for="monto" class="form-label">Proceso</label>
								<p>Salida de dinero</p>
								<label for="monto" class="form-label">Monto</label>
								<p>{{detalles.monto}}</p>
								<label for="monto" class="form-label">Moneda</label>
								<select name="" id="" class="form-select" v-model="detalles.moneda_id">
									<option value="1">Soles</option>
									<option value="2">Dolares</option>
								</select>								
								<label for="monto" class="form-label">Tipo de cambio</label>
								<input type="number" class="form-control" id="monto" placeholder="0.00" v-model="detalles.tipo_cambio">								
								<label for="monto" class="form-label">Observaciones, datos extras</label>
								<input type="text" class="form-control" id="obs" v-model="detalles.observaciones">
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-danger" @click="actualizarEgreso()" data-bs-dismiss="modal">Actualizar salida</button>
						</div>
					</div>
				</div>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted, computed } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const idCaja = ref(-1)
			const apertura = ref({
				apertura: 0, observaciones: '', moneda_id:1
			})
			const bancos = ref([])
			const caja = ref([])
			const movimientos = ref([])
			const detalles = ref([])
			const mIngresos = ref([])
			const mSalidas = ref([])
			const sumaIngresos = ref({ soles: 0, dolares :0 })
			const sumaEgresos = ref({ soles: 0, dolares :0 })

			onMounted(()=>{
				axios.get(servidor+'ultimaCaja')
				.then(response=>{
					caja.value = response.data
					movimientos.value = [...caja.value.movimientos]
					mIngresos.value = [...caja.value.movimientos.filter(movimiento=>movimiento.proceso_id!=2)]
					mSalidas.value = [...caja.value.movimientos.filter(movimiento=>movimiento.proceso_id==2)]
					sumar()
				})
				axios.get(servidor+'bancos').then(response=> bancos.value = response.data.sort((a, b) => a.entidad.localeCompare(b.entidad)) )
			})

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}
			function fechaLatamLarga(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY h:mm a');
			}
			function aperturarCaja(){
				axios.post(servidor+'cajas/', {
					user_id: '<?= $_COOKIE['idUsuario'] ?>',
					apertura: apertura.value.apertura,
					observaciones: apertura.value.observaciones,
				})
				.then(response=>{
					if(response.data.id) location.reload()
				})
			}
			function ingresoACaja(){
				axios.post(servidor+'caja-movimientos', {
					caja_id: caja.value.id,
					proceso_id: 1,
					banco_id: 1, //para qe salga efectivo
					moneda_id: apertura.value.moneda_id,
					monto: apertura.value.apertura,
					observaciones: apertura.value.observaciones,
				})
				.then(response=>{
					movimientos.value.push(response.data)
					mIngresos.value.push(response.data)
				})
			}
			function salidaACaja(){
				axios.post(servidor+'caja-movimientos', {
					caja_id: caja.value.id,
					proceso_id: 2,
					banco_id: 1, //para qe salga efectivo
					moneda_id: apertura.value.moneda_id,
					monto: apertura.value.apertura,
					observaciones: apertura.value.observaciones,
				})
				.then(response=>{
					movimientos.value.push(response.data)
					mSalidas.value.push(response.data)
				})
			}
			function cerrarCaja(){
				if(confirm('¿Está seguro de cerrar la caja?')){
					axios.put(servidor+'cajas/'+caja.value.id, {
						estado: 'cerrada',
						fecha_cierre: moment().format('YYYY-MM-DD HH:mm:ss')
					})
					.then(response=>{
						if(response.data.id) location.reload()
					})
				}
			}

			function sumar(){
				movimientos.value.forEach(movimiento=>{
					if(movimiento.proceso_id==2){
						if(movimiento.moneda_id==1)
							sumaEgresos.value.soles += parseFloat(movimiento.monto)
						else
							sumaEgresos.value.dolares += parseFloat(movimiento.monto)
					}else{
						if(movimiento.moneda_id==1)
							sumaIngresos.value.soles += parseFloat(movimiento.monto)
						else
							sumaIngresos.value.dolares += parseFloat(movimiento.monto)
					}
				})
			}

			function detallesIngreso(index){
				detalles.value = {...mIngresos.value[index]}
			}

			function actualizarIngreso(){
				axios.put(servidor+'caja-movimientos/'+detalles.value.id, detalles.value)
				.then(response=>{
					if(response.data.id) location.reload()
				})
			}
			function detallesSalida(index){
				detalles.value = {...mSalidas.value[index]}
			}

			function actualizarEgreso(){
				axios.put(servidor+'caja-movimientos/'+detalles.value.id, detalles.value)
				.then(response=>{
					if(response.data.id) location.reload()
				})
			}
			
			// Propiedades computadas
			const sumaEgresosC = computed(() => {
				return {
					soles: movimientos.value
						.filter(m => m.proceso_id === 2 && m.moneda_id === 1)
						.reduce((sum, m) => sum + parseFloat(m.monto || 0), 0),
					dolares: movimientos.value
						.filter(m => m.proceso_id === 2 && m.moneda_id !== 1)
						.reduce((sum, m) => sum + parseFloat(m.monto || 0), 0)
				};
			});

			const sumaIngresosC = computed(() => {
				return {
					soles: movimientos.value
						.filter(m => m.proceso_id !== 2 && m.moneda_id === 1)
						.reduce((sum, m) => sum + parseFloat(m.monto || 0), 0),
					dolares: movimientos.value
						.filter(m => m.proceso_id !== 2 && m.moneda_id !== 1)
						.reduce((sum, m) => sum + parseFloat(m.monto || 0), 0)
				};
			});

			

			return {
				idCaja, caja, movimientos,
				fechaLatam, fechaLatamLarga, cerrarCaja, sumaIngresos, sumaEgresos,
				aperturarCaja, apertura, ingresoACaja, salidaACaja, mIngresos, mSalidas, sumaEgresosC, sumaIngresosC, bancos, detalles, detallesIngreso, actualizarIngreso, detallesSalida, actualizarEgreso
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
	#detallesIngreso label{
		font-size:0.8rem!important;
		font-weight: 500!important;
		color:dimgrey!important;
		margin-bottom: 0;
	}
</style>
</body>
</html>