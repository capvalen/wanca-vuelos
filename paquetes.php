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
			<?php  $titulo_pagina = "Paquetes";
			include 'menu_usuario.php'; ?>
			
			<div class="card mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> D.N.I. / R.U.C.</label>
							<input type="text" class="form-control" @keypress.enter="buscarPaquete()" v-model="filtro.dni">
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Nombres / Razón social</label>
							<input type="text" class="form-control" @keypress.enter="buscarPaquete()" v-model="filtro.nombres">
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Nombre de paquete</label>
							<input type="text" class="form-control" @keypress.enter="buscarPaquete()" v-model="filtro.paquete">
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<button class="btn btn-outline-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalBuscar"><i class="bi bi-asterisk"></i> Nuevo paquete</button>
				<button class="btn btn-sm btn-outline-secondary" @click="buscarPaquete()"><i class="bi bi-search"></i> Filtrar</button>
			</div>

			<p>Listado de últimos paquetes</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Cliente</th>
					<th>Nombre de paquete</th>
					<th>Destino</th>
					<th>Costo</th>
					<th>Aumento</th>
					<th>Precio final</th>
					<th>Fecha de salida</th>
					<th>N° participantes</th>
					<th>N° liberados</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr v-for="(paquete, index) in paquetes">
							<td>{{index+1}}</td>
							<td class="text-capitalize"><a :href="'paquete-detalle.php?id='+paquete.cliente.id" class="text-decoration-none">{{paquete.cliente.razon}}</a></td>
							<td class="text-capitalize"><a :href="'paquete-detalle.php?id='+paquete.id" class="text-decoration-none">{{paquete.paquete}}</a></td>
							<td>{{paquete.destino.destino}}</td>
							<td>
								<span v-if="paquete.moneda==1">S/</span> 
								<span v-else>$</span> 
								<span>{{paquete.costo}}</span> 
							</td>
							<td>
								<span v-if="paquete.moneda==1">S/</span> 
								<span v-else>$</span> 
								<span>{{paquete.adicional}}</span> 
							</td>
							<td>
								<span v-if="paquete.moneda==1">S/</span> 
								<span v-else>$</span> 
								<span>{{paquete.precio}}</span> 
							</td>
							<td>{{fechaLatam(paquete.salida)}}</td>
							<td>{{paquete.participantes.length}}</td>
							<td>{{paquete.liberados.length}}</td>
							<td>
								<a href="aportacion-servicio.php?id=36" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Aportación</a>
							</td>
					</tr>
			</tbody>

			</table>

		</section>

		<section>
			<!-- Modal -->
			<div class="modal fade" id="modalBuscar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Crear paquete</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p>Primero debe seleccionar al cliente para crear un paquete</p>
							<label class="mb-1"><i class="bi bi-search"></i> Búsqueda </label>
							<div class="input-group mb-3">
								<input type="text" class="form-control mb-0" v-model="busqueda" placeholder="Por RUC/ DNI o Razón social / Apellidos" @keypress.enter="buscarCliente()">
								<button class="btn btn-outline-secondary" type="button" id="btnBuscar" @click="buscarCliente()"><i class="bi bi-search"></i> Buscar</button>
							</div>
							<table class="table table-hover mt-4">
								<thead>
									<th>N°</th>
									<th>D.N.I.</th>
									<th>Nombre y apellidos</th>
									<th>@</th>
								</thead>
								<tbody>
									<tr v-for="(cliente, index) in clientes">
										<td>{{index+1}}</td>
										<td>{{cliente.ruc}}</td>
										<td class="text-capitalize">{{cliente.razon}}</td>
										<td>
											<a class="btn btn-outline-primary btn-sm" :href="'http://localhost/wanca-vuelos/cliente-paquete-nuevo.php?id='+cliente.id"><i class="bi bi-plus"></i></a>
										</td>
									</tr>
									<tr v-if="clientes.length==0">
										<td colspan="6">No hay clientes registrados</td>
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
			const clientes = ref([])
			const paquetes = ref([])
			const busqueda = ref(null)
			const filtro = ref({ruc:'', razon:'', paquete:''})
			const servidor = '<?= $api ?>'
			
			onMounted(()=>{
				axios.get(servidor+'paquetes')
				.then(response=> paquetes.value = response.data )				
			})

			function actualizar(){
				axios.put(servidor+'clients/'+cliente.value.id, registro.value)
				.then(resp=>{
					if(resp.data.id) location.reload()
				})
			}
			function buscarCliente(){
				axios.post(servidor+'filtrarCliente', {texto: busqueda.value})
				.then(response=>{
					clientes.value = response.data
				})
			}
			function buscarPaquete(){
				axios.post(servidor+'filtrarPaquete', {
					paquete: filtro.value.paquete, ruc: filtro.value.dni, razon: filtro.value.nombres
				}).then(response=>{
					paquetes.value = response.data
				})
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				actualizar, paquetes, buscarCliente,clientes,busqueda, buscarPaquete, filtro,
				fechaLatam
			}
		}
	}).mount('#app')
</script>
<style scoped>
	label{font-weight: bold; color:#323232;}
</style>
</body>
</html>