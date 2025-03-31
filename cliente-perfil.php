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
			<?php  $titulo_pagina = "Perfil resulmen del cliente";
			include 'menu_usuario.php'; ?>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<label for="">R.U.C. / D.N.I.</label>
							<p class="mb-0">{{cliente.ruc}}</p>
						</div>
						<div class="col-4">
							<label for="">Nombre</label>
							<p class="mb-0">{{cliente.razon}}</p>
						</div>
						<div class="col-4">
							<label for="">Registro</label>
							<p class="mb-0">{{fechaLatam(cliente.created_at)}}</p>
						</div>
						<div class="col-6">
							<label for="">Datos adicionales</label>
							<p class="mb-0">{{cliente.observaciones}}</p>
							<p v-if="!cliente.observaciones" class="mb-0">Ninguna</p>
						</div>
					</div>
				</div>
			</div>
			<div class="my-2 ">
				<a :href="'cliente-paquete-nuevo.php?id='+idCliente" class="btn btn-outline-primary btn-sm mx-1"><i class="bi bi-asterisk"></i> Nuevo paquete</a>
				<div class="btn btn-outline-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalActualizar"><i class="bi bi-pencil-square"></i> Editar cliente</div>
			</div>

			<p>Documentación</p>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>N°</th>
						<th>Documento</th>
						<th>Entregado</th>
						<th>Fecha de entrega</th>
						<th>Obs.</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(documento, index) in cliente.documentos" :key="documento.id" id="documentos">
						<td>{{index+1}}</td>
						<td>{{documento.nombre_documento}}</td>
						<td>
							<select class="form-select" id="sltEntregado" v-model="documento.entregado" @change="actualizarDocumento(index)" v-if="![10,11].includes(documento.documento_id)">
								<option value="0">No entregado</option>
								<option value="1">Entregado</option>
							</select>
						</td>
						<td>
							<input type="date" class="form-control" v-model="documento.fecha_entrega" @change="actualizarDocumento(index)" v-if="![10,11].includes(documento.documento_id)">
						</td>
						<td>
							<input type="text" class="form-control" v-model="documento.extra" @change="actualizarDocumento(index)">
						</td>
					</tr>
					<tr v-if="cliente.documentos?.length==0">
						<td colspan="5">No hay documentos</td>
					</tr>
				</tbody>
			</table>
			<p class="mt-3">Listado de paquetes asociados</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Nombre de paquete</th>
					<th>Costo</th>
					<th>Aumento</th>
					<th>Precio final</th>
					<th>Fecha de salida</th>
					<th>N° participantes</th>
					<th>N° liberados</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr v-for="(paquete, index) in cliente.paquetes">
							<td>{{index+1}}</td>
							<td class="text-capitalize"><a :href="'paquete-detalle.php?id='+paquete.id" class="text-decoration-none">{{paquete.paquete}}</a></td>
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
			<div class="d-flex justify-content-center mb-3">
				<button class="btn btn-primary btn-lg" ><i class="bi bi-file-earmark"></i> Imprimir constancia</button>
			</div>
		</section>

		<section>
			<!-- Modal -->
			<div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header border-0">
							<h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar cliente</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-6">
									<label for="">R.U.C. / D.N.I.</label>
									<input type="text" class="form-control" v-model="registro.ruc">
								</div>
								<div class="col-6">
									<label for="">Razón social / Nombres</label>
									<input type="text" class="form-control" v-model="registro.razon">
								</div>
								<div class="col-12">
									<label for="">Datos adicionales</label>
									<input type="text" class="form-control" v-model="registro.observaciones">
								</div>
							</div>
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" @click="actualizar()"><i class="bi bi-floppy"></i> Actualizar campos</button>
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
			const cliente = ref([])
			const registro = ref({ruc:'', razon:'', observaciones:''})
			const servidor = '<?= $api ?>'
			const idCliente = ref(-1)

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idCliente.value = urlParams.get('id');

				axios.get(servidor+'clients/'+idCliente.value)
				.then(response=>{
					cliente.value = response.data
				})
			})

			function actualizar(){
				axios.put(servidor+'clients/'+cliente.value.id, registro.value)
				.then(resp=>{
					if(resp.data.id) location.reload()
				})
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			function actualizarDocumento(index){
				delete cliente.value.documentos[index].updated_at;
				axios.put(servidor+'cliente-documentos/'+cliente.value.documentos[index].id, cliente.value.documentos[index])
				.then(resp=>{
					//if(resp.data.id) location.reload()
				})
			}

			return {
				cliente, registro, actualizar, idCliente,
				fechaLatam, actualizarDocumento
			}
		}
	}).mount('#app')
</script>
<style scoped>
	label{font-weight: bold; color:#323232;}
	#documentos .form-select, #documentos .form-control{
		margin-bottom:0px
	}
</style>
</body>
</html>