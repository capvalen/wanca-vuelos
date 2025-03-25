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
			<?php  $titulo_pagina = "Sección proveedores";
			include 'menu_usuario.php'; ?>
			<a href="proveedor-nuevo.php" class="btn btn-outline-success btn-sm"><i class="bi bi-asterisk"></i> Crear nuevo proveedor</a>
			<p>Los últimos 50 proveedores</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Nombre</th>
					<th>Concepto</th>
					<th>Ciudad</th>
					<th>Servicio</th>
					<th>Fecha de inicio</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr v-for="(proveedor, index) in proveedores" :key="proveedor.id">
						<td>{{index+1}}</td>
						<td><a class="text-decoration-none" :href="'proveedor-perfil.php?id='+proveedor.id">{{proveedor.nombre}}</a></td>
						<td>{{proveedor.concepto_nombre}}</td>
						<td>{{proveedor.destino_nombre}}</td>
						<td>{{proveedor.servicio_nombre}}</td>
						<td>{{fechaLatam(proveedor.inicio)}}</td>
						<td>
							<a :href="'proveedor-perfil.php?id='+proveedor.id" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></a>
							<button class="btn btn-outline-danger btn-sm" @click="eliminar(index, proveedor.id)"><i class="bi bi-x"></i></button>
						</td>
					</tr>
			</tbody>


			</table>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const proveedores = ref([])

			onMounted(()=>{
				axios.get(servidor+'proveedores').then(response=>{ proveedores.value = response.data })
			})

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			function eliminar(index, id){
				if(confirm(`¿Estás seguro de eliminar este proveedor ${proveedores.value[index].nombre}?`)){
					axios.delete(servidor+'proveedores/'+id).then(response=>{
						proveedores.value.splice(index, 1)
					})
				}
			}
			
			return {
				proveedores, fechaLatam, eliminar
			}
		}
	}).mount('#app')
</script>
</body>
</html>