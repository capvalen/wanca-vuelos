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
		<article class="col col-md-9 container mb-3 p-4 pt-3 border-start">
			<?php $titulo_pagina = "Sección Clientes";
			include 'menu_usuario.php'; ?>
			
			<div class="card mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> D.N.I. / R.U.C.</label>
							<input type="text" class="form-control" @keypress.enter="buscarCliente()" v-model="filtro.dni">
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Nombres / Razón social</label>
							<input type="text" class="form-control" @keypress.enter="buscarCliente()" v-model="filtro.nombres">
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div class="gap-2">
					<a href="cliente-nuevo.php" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-person-circle"></i> Nuevo cliente</a>
				</div>
				<button class="btn btn-sm btn-outline-secondary" @click="buscarCliente()"><i class="bi bi-search"></i> Filtrar</button>
			</div>

			<section class="mt-3" id="resultados">
				<p>Los 50 últimos clientes registrados:</p>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>DNI / RUC</th>
						<th>Razón social / Nombres</th>
						<th>@</th>
					</thead>
					<tbody>
						<tr v-for="(cliente, index) in clientes" :key="cliente.id">
							<td>{{index+1}}</td>
							<td>{{cliente.ruc}}</td>
							<td><a :href="'cliente-perfil.php?id='+cliente.id" class="text-decoration-none">{{cliente.razon}}</a></td>
							<td>
								<a :href="'cliente-paquete-nuevo.php?id='+cliente.id" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-asterisk"></i> Nuevo paquete</a>
								<button class="btn btn-outline-danger me-1" @click="eliminar(index, cliente.id)"><i class="bi bi-eraser"></i> Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>
		</section>

		</article>

		
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const clientes = ref([])
			const servidor = '<?= $api ?>'
			const filtro = ref({dni: '', nombres: ''})

			onMounted(()=>{
				axios.get(servidor+'clients')
				.then(response=>{
					clientes.value = response.data
				})				
			})

			function buscarCliente(index, id){
				axios.post(servidor+'buscarCliente', {
					dni: filtro.value.dni, nombres: filtro.value.nombres
				}).then(response=>{
					clientes.value = response.data
				})
			}
			
			function eliminar(index, id){
				if(confirm(`¿Estás seguro de eliminar al cliente ${clientes.value[index].razon}?`)){
					axios.delete(servidor+'clients/'+id).then(response=>{
						clientes.value.splice(index, 1)
					})
				}
			}
			
			return {
				clientes, eliminar, buscarCliente, filtro
			}
		}
	}).mount('#app')
</script>
</body>
</html>