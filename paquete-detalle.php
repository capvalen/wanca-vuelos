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
			<?php $titulo_pagina= "Edición de paquete del cliente";
			include 'menu_usuario.php'; ?>
			
			<div class="row">
				<div class="col-6">
					<label for="">RUC / DNI</label>
					<input type="text" class="form-control" readonly v-model="paquete.cliente.ruc">
				</div>
				<div class="col-6">
					<label for="">Cliente</label>
					<input type="text" class="form-control" readonly v-model="paquete.cliente.razon">
				</div>
				<div class="col-6">
					<label for="">Paquete seleccionado</label>
					<input type="text" class="form-control" readonly v-model="paquete.paquete">
				</div>				
				<div class="col-6">
					<label for="">Destino</label>
					<select id="sltDestino" class="form-select" v-model="paquete.destino_id">
						<option v-for="destino in destinos" :value="destino.id">{{destino.destino}}</option>
					</select>
				</div>
				<div class="col-6">
					<label for="">Fecha de salida</label>
					<input type="date" class="form-control" v-model="paquete.salida">
				</div>
				<div class="col-6">
					<label for="">Fecha de regreso</label>
					<input type="date" class="form-control" v-model="paquete.regreso">
				</div>
				<div class="col-6">
					<label for="">Moneda</label>
					<select name="" id="" class="form-select" v-model="paquete.moneda_id">
						<option value="1">Soles</option>
						<option value="2">Dólares</option>
					</select>
				</div>
				<div class="col-6">
					<label for="">Costo del paquete</label>
					<input type="number" class="form-control" v-model="paquete.costo">
				</div>
				<div class="col-6">
					<label for="">Costo adicional</label>
					<input type="number" class="form-control" v-model="paquete.adicional">
				</div>
				<div class="col-6">
					<label for="">Motivo del adicional</label>
					<input type="text" class="form-control" v-model="paquete.motivo">
				</div>
				<div class="col-6">
					<label for="">Precio final</label>
					<input type="number" class="form-control" v-model=" paquete.precio" readonly>
				</div>
				<div class="col-6 d-flex align-items-center">
					<button class="btn btn-success" @click="actualizarPaquete()"><i class="bi bi-floppy"></i> Editar paquete</button>
				</div>
				
				
				<div class="col-12 mt-4">
					<div class="card">
						<div class="card-body p-2">
							<div class="d-flex justify-content-between">
								<label for=""><small>Cuotas y fechas</small></label>
								<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCuota"><i class="bi bi-plus-lg"></i> Agregar cuota</button>
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
									<tr v-for="(cuota, index) in paquete.cuotas">
										<td>{{index+1}}</td>
										<td><input type="number" class="form-control" v-model="cuota.monto"></td>
										<td><input type="date" class="form-control" v-model="cuota.desde"></td>
										<td><input type="date" class="form-control" v-model="cuota.hasta"></td>
										<td>
											<button class="btn btn-outline-danger btn-sm" @click="eliminarCuota(cuota.id, index)"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr v-if="paquete.cuotas.length==0">
										<td colspan="5">No hay cuotas programadas</td>
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
								<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalViaje"><i class="bi bi-plus-lg"></i> Agregar destino</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Salida el día</th>
									<th>Desde</th>
									<th>Llegada</th>
									<th>Ciudad</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(viaje, index) in paquete.viajes">
										<td>{{index+1}}</td>
										<td>{{fechaLatam(viaje.fecha_salida)}}</td>
										<td class="text-capitalize">{{viaje.ciudad_salida}}</td>
										<td>{{fechaLatam(viaje.fecha_llegada)}}</td>
										<td class="text-capitalize">{{viaje.ciudad_llegada}}</td>
										<td>
											<button class="btn btn-outline-danger btn-sm" @click="eliminarViajes(viaje.id, index)"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr v-if="paquete.viajes.length==0">
										<td colspan="5">No hay viajes programados</td>
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
								<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalParticipantes"><i class="bi bi-plus-lg"></i> Agregar participantes</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>D.N.I.</th>
									<th>Nombre y apellidos</th>
									<th>N° Pasaporte</th>
									<th>Celular</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(participante, index) in paquete.participantes">
										<td>{{index+1}}</td>
										<td>{{participante.dni}}</td>
										<td class="text-capitalize"><a :href="'participante-perfil.php?id='+participante.id" class="text-decoration-none">{{participante.apellidos}} {{participante.nombres}}</a></td>
										<td>{{participante.pasaporte ?? '-'}}</td>
										<td>{{participante.celular}}</td>
										<td>
											<button class="btn btn-outline-danger btn-sm" @click="eliminarParticipantes(index)"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr v-if="paquete.participantes.length==0">
										<td colspan="5">No hay participantes registrados</td>
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
								<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalProveedores"><i class="bi bi-plus-lg"></i> Agregar proveedor</button>
							</div>
							<table class="table table-hover">
								<thead>
									<th>N°</th>
									<th>Proveedor</th>
									<th>Servicio</th>
									<th>Concepto</th>
									<th>Fecha inicio</th>
									<th>Fecha final</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(proveedor, index) in paquete.proveedores">
										<td>{{index+1}}</td>
										<td>{{proveedor.nombre}}</td>
										<td>{{proveedor.servicio_nombre}}</td>
										<td>{{proveedor.concepto_nombre}}</td>
										<td>
											<input type="date" class="form-control" v-model="proveedor.fecha_inicio" @change="actualizarFechaProveedor(index)">
										</td>
										<td>
											<input type="date" class="form-control" v-model="proveedor.fecha_final" @change="actualizarFechaProveedor(index)">
										</td>
										<td>
											<button class="btn btn-outline-danger btn-sm" @click="eliminarProveedor(index)"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr v-if="paquete.proveedores.length==0">
										<td colspan="7">No hay proveedores registrados</td>
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
								<button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalLiberados"><i class="bi bi-plus-lg"></i> Agregar liberado</button>
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
									<tr v-for="(liberado, index) in paquete.liberados">
										<td>{{index+1}}</td>
										<td>{{liberado.apellidos}} {{liberado.nombres}}</td>
										<td>{{liberado.dni}}</td>
										<td>{{liberado.celular}}</td>
										<td>{{liberado.relacion.relacion}}</td>
										<td>
											<button class="btn btn-outline-danger btn-sm" @click="eliminarLiberados(index)"><i class="bi bi-x"></i></button>
										</td>
									</tr>
									<tr v-if="paquete.liberados.length==0">
										<td colspan="5">No hay liberados registrados</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				
				

			</div>
		</section>

		<section>
			<!-- Modal -->
			<div class="modal fade" id="modalCuota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar cuota</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<label for="">Monto</label>
							<input type="number" class="form-control" v-model="registroCuota.monto">
							<label for="">Desde</label>
							<input type="date" class="form-control" v-model="registroCuota.desde">
							<label for="">Hasta</label>
							<input type="date" class="form-control" v-model="registroCuota.hasta">
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" @click="guardarCuota()"><i class="bi bi-plus-lg"></i> Agregar cuota</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalViaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar fechas y destinos</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							
							<label for="">Salida el día</label>
							<input type="date" class="form-control" v-model="registroViaje.fecha_salida">
							<label for="">Ciudad de salida</label>
							<input type="string" class="form-control" v-model="registroViaje.ciudad_salida">
							<label for="">Llegada el día</label>
							<input type="date" class="form-control" v-model="registroViaje.fecha_llegada">
							<label for="">Ciudad de llegada</label>
							<input type="string" class="form-control" v-model="registroViaje.ciudad_llegada">
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" @click="guardarViaje()"><i class="bi bi-plus-lg"></i> Agregar cuota</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalParticipantes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar participantes</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<label class="mb-1"><i class="bi bi-search"></i> Búsqueda </label>
							<div class="input-group mb-3">
								<input type="text" class="form-control mb-0" v-model="busqueda" placeholder="Por DNI o Apellidos y Nombres, celular" @keypress.enter="buscarParticipante()">
								<button class="btn btn-outline-secondary" type="button" id="btnBuscar" @click="buscarParticipante()"><i class="bi bi-search"></i> Buscar</button>
							</div>
							<table class="table table-hover mt-4">
								<thead>
									<th>N°</th>
									<th>D.N.I.</th>
									<th>Nombre y apellidos</th>
									<th>Celular</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(participante, index) in participantes">
										<td>{{index+1}}</td>
										<td>{{participante.dni}}</td>
										<td class="text-capitalize">{{participante.apellidos}} {{participante.nombres}}</td>
										<td>{{participante.celular}}</td>
										<td>
											<button class="btn btn-outline-primary btn-sm" @click="agregarParticipante(participante.id)" data-bs-dismiss="modal"><i class="bi bi-plus"></i></button>
										</td>
									</tr>
									<tr v-if="participantes.length==0">
										<td colspan="6">No hay participantes registrados</td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalLiberados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar liberados</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<label class="mb-1"><i class="bi bi-search"></i> Búsqueda </label>
							<div class="input-group mb-3">
								<input type="text" class="form-control mb-0" v-model="busqueda" placeholder="Por DNI o Apellidos y Nombres, celular" @keypress.enter="buscarLiberado()">
								<button class="btn btn-outline-secondary" type="button" id="btnBuscar3" @click="buscarLiberado()"><i class="bi bi-search"></i> Buscar</button>
							</div>
							<table class="table table-hover mt-4">
								<thead>
									<th>N°</th>
									<th>D.N.I.</th>
									<th>Nombre y apellidos</th>
									<th>Celular</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(liberado, index) in liberados">
										<td>{{index+1}}</td>
										<td>{{liberado.dni}}</td>
										<td class="text-capitalize">{{liberado.apellidos}} {{liberado.nombres}}</td>
										<td>{{liberado.celular}}</td>
										<td>
											<button class="btn btn-outline-primary btn-sm" @click="agregarLiberado(liberado.id)" data-bs-dismiss="modal"><i class="bi bi-plus"></i></button>
										</td>
									</tr>
									<tr v-if="liberados.length==0">
										<td colspan="6">No hay liberados registrados</td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar proveedores</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<label class="mb-1"><i class="bi bi-search"></i> Búsqueda </label>
							<div class="input-group mb-3">
								<input type="text" class="form-control mb-0" v-model="busqueda" placeholder="Por Nombres, contacto" @keypress.enter="buscarProveedor()">
								<button class="btn btn-outline-secondary" type="button" id="btnBuscarProveedor" @click="buscarProveedor()"><i class="bi bi-search"></i> Buscar</button>
							</div>
							<table class="table table-hover mt-4">
								<thead>
									<th>N°</th>
									<th>Nombre</th>
									<th>Concepto</th>
									<th>Ciudad</th>
									<th>Servicio</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(proveedor, index) in proveedores">
										<td>{{index+1}}</td>
										<td>{{proveedor.nombre}}</td>
										<td>{{proveedor.concepto_nombre}}</td>
										<td>{{proveedor.destino_nombre}}</td>
										<td>{{proveedor.servicio_nombre}}</td>
										<td>
											<button class="btn btn-outline-primary btn-sm" @click="agregarProveedor(proveedor.id)" data-bs-dismiss="modal"><i class="bi bi-plus"></i></button>
										</td>
									</tr>
									<tr v-if="proveedores.length==0">
										<td colspan="6">No hay proveedores registrados</td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const paquete = ref({cliente:[], destino:[], cuotas:[], viajes:[], participantes:[], proveedores:[], liberados:[]})
			const servidor = '<?= $api ?>'
			const busqueda = ref('')
			const participantes = ref([])
			const destinos = ref([])
			const liberados = ref([])
			const proveedores = ref([])
			const registroCuota = ref({monto:0, desde:null, hasta:null, paquete_id:-1})
			const registroViaje = ref({fecha_salida:null, ciudad_salida:null, fecha_llegada:null, ciudad_llegada: null, paquete_id:-1})
			const idPaquete = ref(-1)

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idPaquete.value = urlParams.get('id');

				registroCuota.value.paquete_id = idPaquete.value
				registroViaje.value.paquete_id = idPaquete.value

				axios.get(servidor+'paquetes/'+idPaquete.value)
				.then(response=>{
					paquete.value = response.data
				})
				axios.get(servidor+'destinos').then(response=> destinos.value = response.data)
			})

			function guardarCuota(){
				axios.post(servidor+'cuotas', registroCuota.value)
				.then(resp=>{
					if(resp.data.id) paquete.value.cuotas.push(resp.data)
				})
			}
			function guardarViaje(){
				axios.post(servidor+'viajes', registroViaje.value)
				.then(resp=>{
					if(resp.data.id) paquete.value.viajes.push(resp.data)
				})
			}
			function actualizarPaquete(){
				axios.put(servidor+'paquetes/'+paquete.value.id, {paquete: paquete.value})
				.then(resp=>{
					alert('Paquete actualizado')
				})
			}
			
			function buscarParticipante(){
				axios.post(servidor+'buscarParticipante', {texto: busqueda.value})
				.then(response=>{
					participantes.value = response.data
				})
			}
			function buscarLiberado(){
				axios.post(servidor+'filtrarLiberado', {texto: busqueda.value})
				.then(response=>{
					liberados.value = response.data
				})
			}

			function agregarParticipante(id){
				axios.post(servidor+'paquete-participante', {participante_id: id, paquete_id: idPaquete.value})
				.then(resp=>{
					if(resp.data.id) paquete.value.participantes.push(resp.data)
				})
			}
			function agregarLiberado(id){
				axios.post(servidor+'paquete-liberado', {liberado_id: id, paquete_id: idPaquete.value})
				.then(resp=>{
					if(resp.data.id) paquete.value.liberados.push(resp.data)
				})
			}
			function buscarProveedor(){
				axios.post(servidor+'buscarProveedor', {texto: busqueda.value})
				.then(response=>{
					proveedores.value = response.data
				})
			}
			
			function agregarProveedor(id){
				console.log(id)
				axios.post(servidor+'paquete-proveedor', {proveedor_id: id, paquete_id: idPaquete.value})
				.then(resp=>{
					if(resp.data.id) paquete.value.proveedores.push(resp.data)
				})
			}

			function eliminarCuota(id, index){
				if( confirm(`¿Está seguro de eliminar esta cuota de valor ${paquete.value.cuotas[index].monto}?`) )
				axios.delete(servidor+'cuotas/'+paquete.value.cuotas[index].id)
				.then(resp=>{
					paquete.value.cuotas.splice(index, 1)
				})
			}
			function eliminarViajes(id, index){
				if( confirm(`¿Está seguro de eliminar el viaje con salida ${paquete.value.viajes[index].ciudad_salida} y llegada ${paquete.value.viajes[index].ciudad_llegada}?`) )
				axios.delete(servidor+'viajes/'+paquete.value.viajes[index].id)
				.then(resp=>{
					paquete.value.viajes.splice(index, 1)
				})
			}
			function eliminarParticipantes(index){
				const id = paquete.value.participantes[index].pivot.id
				if( confirm(`¿Está seguro de eliminar al participante ${paquete.value.participantes[index].apellidos} ${paquete.value.participantes[index].nombres}?`) )
				axios.delete(servidor+'paquete-participante/'+id)
				.then(resp=>{
					paquete.value.participantes.splice(index, 1)
				})
			}
			function eliminarLiberados(index){
				const id = paquete.value.liberados[index].pivot.id
				if( confirm(`¿Está seguro de eliminar al liberado ${paquete.value.liberados[index].apellidos} ${paquete.value.liberados[index].nombres}?`) )
				axios.delete(servidor+'paquete-liberado/'+id)
				.then(resp=>{
					paquete.value.liberados.splice(index, 1)
				})
			}
			function eliminarProveedor(index){
				const id = paquete.value.proveedores[index].pivot.id
				if( confirm(`¿Está seguro de eliminar al proveedor ${paquete.value.proveedores[index].nombre}?`) )
				axios.delete(servidor+'paquete-proveedor/'+id)
				.then(resp=>{
					paquete.value.proveedores.splice(index, 1)
				})
			}

			function actualizarFechaProveedor(index){
				axios.put(servidor+'paquete-proveedor/'+paquete.value.proveedores[index].id, paquete.value.proveedores[index])
				.then(resp=>{
					console.log(resp.data)
				})
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				paquete,fechaLatam, registroCuota, guardarCuota, eliminarCuota, registroViaje, guardarViaje, busqueda, participantes, buscarParticipante, busqueda, agregarParticipante, buscarProveedor, agregarProveedor, proveedores, eliminarProveedor, eliminarViajes, eliminarParticipantes, buscarLiberado, liberados, agregarLiberado, eliminarLiberados, destinos, actualizarPaquete, actualizarFechaProveedor
			}
		}
	}).mount('#app')
</script>
<style>
	input:read-only, input:read-only:hover, input:read-only:focus, input:read-only:active {
		background-color: #f0f0f0; /* Gris suave */
		box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Sombra suave opcional */
		border: 1px solid #ddd; /* Borde suave opcional */
	}
	label{font-weight: bold; color:#323232;}
</style>
</body>
</html>