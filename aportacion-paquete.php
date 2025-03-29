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
					<p>{{paquete.cliente.razon}}</p>
				</div>
				<div class="col">
					<label for="">Paquete</label>
					<p>{{paquete.paquete}}</p>
				</div>
				<div class="col">
					<label for="">Costo</label>
					<p>
						<span v-if="paquete.moneda_id==1">S/</span>
						<span v-if="paquete.moneda_id==2">$</span>
						 {{paquete.costo}}</p>
				</div>
				<div class="col">
					<label for="">Adicional</label>
					<p>
						<span v-if="paquete.moneda_id==1">S/</span>
						<span v-if="paquete.moneda_id==2">$</span>
						 {{paquete.adicional}}</p>
				</div>
				<div class="col">
					<label for="">Pago final</label>
					<p>
						<span v-if="paquete.moneda_id==1">S/</span>
						<span v-if="paquete.moneda_id==2">$</span>
						 {{paquete.precio}}</p>
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
					<tr v-for="(viaje, index) in paquete.viajes">
						<td>{{index+1}}</td>
						<td>{{fechaLatam(viaje.fecha_salida)}}</td>
						<td>{{viaje.ciudad_salida}}</td>
						<td>{{fechaLatam(viaje.fecha_llegada)}}</td>
						<td>{{viaje.ciudad_llegada}}</td>
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
					<tr v-for="(cuota, index) in paquete.cuotas">
						<td>1</td>
						<td>S/ {{cuota.monto}}</td>
						<td>{{fechaLatam(cuota.desde)}}</td>
						<td>{{fechaLatam(cuota.hasta)}}</td>
					</tr>
				</tbody>
			</table>

		<div class="card my-2">
			<div class="card-body">
				<label for=""><small>Agregar aportación</small></label>
				<div class="row">
					<div class="col-md-4">
						<label for="">Tipo de participante</label>
						<select class="form-select" v-model="aportacion.tipo_participante">
							<option value="personal">Personal</option>
							<option value="junta">Como Junta directiva</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="">Entidad (cliente)</label>
						<select name="" id="" class="form-select" v-model="aportacion.client_id" @change="cambiarPaquetes()">
							<option v-for="entidad in entidades" :value="entidad.id">{{entidad.razon}}</option>
						</select>
					</div>
					<div class="col-md-4" >
						<label for="">Paquete</label>
						<select name="" id="" class="form-select" v-model="aportacion.paquete_id" @change="cambiarParticipantes()">
							<template v-for="paquete in paquetes" >
								<option :value="paquete.id">{{paquete.paquete}}</option>
							</template>
						</select>
					</div>
					<div class="col-md-4" v-show="aportacion.tipo_participante=='personal'">
						<label for="">Participante</label>
						<select name="" id="" class="form-select" v-model="aportacion.participante_id">
							<template v-for="participante in participantes">
								<option :value="participante.id">{{participante.apellidos}} {{participante.nombres}}</option>
							</template>
							<option v-if="participantes.length==0" value="-1">No hay participantes registrados</option>
						</select>
					</div>
					<div class="col-md-4">
						<label for="">Monto</label>
						<input type="number" class="form-control" v-model="aportacion.monto">
					</div>
					<div class="col-md-4">
						<label for="">Tipo de moneda</label>
						<select class="form-select" v-model="aportacion.moneda_id">
							<option value="1">Soles</option>
							<option value="2">Dólares</option>
						</select>
					</div>
					<div class="col-md-4" v-show="aportacion.moneda_id==2">
						<label for="">Tipo de cambio</label>
						<input type="number" class="form-control" v-model="aportacion.tipo_cambio">
					</div>
					<div class="col-md-12">
						<label for="">Concepto de pago</label>
						<select class="form-select" id="sltProcesos" v-model="aportacion.proceso_id">
							<template v-for="proceso in procesos">
								<option :value="proceso.id" v-if="![1, 2].includes(proceso.id)">{{proceso.descripcion_larga}}</option>			
							</template>
						</select>
					</div>
					<div class="col-md-12" v-if="aportacion.proceso_id == 10">
						<label for="">Concepto otros</label>
						<input type="text" class="form-control" v-model="aportacion.observaciones">
					</div>					
					<div class="col-md-4">
						<label for="">Depósito a cuenta</label>
						<select name="" id="" class="form-select" v-model="aportacion.aCuenta">
							<option value="1">Si</option>
							<option value="0">No</option>
						</select>
					</div>
					<div class="col-md-4" v-show="aportacion.aCuenta == 1">
						<label for="">Banco</label>
						<select name="" id="" class="form-select" v-model="aportacion.banco_id">
							<option v-for="banco in bancos" :value="banco.id">{{banco.entidad}}</option>
						</select>
					</div>
					<div class="col-md-4" v-show="aportacion.aCuenta == 1">
						<label for="">Titular de la cuenta</label>
						<select name="" id="" class="form-select" v-model="aportacion.cuenta">
							<option value="Nery">Nery</option>
							<option value="Tradition">Tradition</option>
							<option value="Christian">Christian</option>
						</select>
					</div>
					<div class="col-md-4" v-show="aportacion.aCuenta == 1">
						<label for="">Fecha de depósito</label>
						<input type="date" class="form-control" v-model="aportacion.fecha_deposito">
					</div>
					<div class="col-md-4" v-show="aportacion.aCuenta == 1">
						<label for="">N° de operación</label>
						<input type="text" class="form-control" v-model="aportacion.num_operacion">
					</div>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-end">
			<button v-if="caja.estado=='abierta'" class="btn btn-outline-success" @click="addPago()"><i class="bi bi-box-arrow-in-down"></i> Adicionar pago</button>
			<p v-else ><i class="bi bi-piggy-bank"></i> No hay caja aperturada</p>
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
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const bancos = ref([])
			const caja = ref([])
			const procesos = ref([])
			const participantes = ref([])
			const aportacion = ref({
				caja_id:-1,tipo_participante: 'junta', moneda_id:1, aCuenta:0, participante_id:null, banco_id:1
			})
			const entidades = ref([])
			const idPaquete = ref(-1)
			const paquete = ref({ cliente:[] })
			const paquetes = ref([])

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idPaquete.value = urlParams.get('id');

				axios.get(servidor+'paquetes/'+idPaquete.value)
				.then(response=>{
					paquete.value = response.data
				})
				axios.get(servidor+'clients').then(response=> entidades.value = response.data.sort((a, b) => a.razon.localeCompare(b.razon)) )
				axios.get(servidor+'bancos').then(response=> bancos.value = response.data.sort((a, b) => a.entidad.localeCompare(b.entidad)) )
				axios.get(servidor+'procesos').then(response=> procesos.value = response.data.sort((a, b) => a.descripcion_larga.localeCompare(b.descripcion_larga)))
				axios.get(servidor+'ultimaCaja').then(response=>{
					caja.value = response.data
					if(caja.value.estado=='abierta') aportacion.value.caja_id= caja.value.id
				})
			})

			function addPago(){
				axios.post(servidor+'caja-movimientos', aportacion.value)
				.then(response=> console.log(response.data))
			}

			function cambiarPaquetes(){
				paquetes.value = entidades.value.filter(x=> x.id == aportacion.value.client_id).flatMap(x => x.paquetes);

				aportacion.value.participante_id=null
				console.log('borrar', aportacion.value.participante_id)
			}
			function cambiarParticipantes(){
				aportacion.value.participante_id=null
				participantes.value = paquetes.value.filter(x=> x.id == aportacion.value.paquete_id).flatMap(x => x.participantes).sort((a, b) => a.apellidos.localeCompare(b.apellidos));
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}
			
			return {
				paquete, bancos, idPaquete, fechaLatam, caja, aportacion, entidades, procesos, addPago, cambiarPaquetes, paquetes,
				cambiarParticipantes, participantes
			}
		}
	}).mount('#app')
</script>
</body>
</html>