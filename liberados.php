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
			<?php  $titulo_pagina = "Sección liberados";
			include 'menu_usuario.php'; ?>
			
			<div class="card mb-2">
				<div class="card-body">
					<div class="row">
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> D.N.I. </label>
							<input type="text" class="form-control" @keypress.enter="buscar()" v-model="filtro.dni">
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Apellidos y Nombres</label>
							<input type="text" class="form-control" @keypress.enter="buscar()" v-model="filtro.nombres">
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div class="gap-2">
				<a href="liberado-nuevo.php" class="btn btn-outline-success btn-sm"><i class="bi bi-asterisk"></i> Crear nuevo liberado</a>
				</div>
				<button class="btn btn-sm btn-outline-secondary" @click="buscar()"><i class="bi bi-search"></i> Filtrar</button>
			</div>

			
			<div class="resultados mt-3">
				<p>Los últimos 50 liberados</p>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>D.N.I.</th>
						<th>Apellidos y nombres</th>
						<th>Contacto</th>
						<th>@</th>
					</thead>
					<tbody>
						<tr v-for="(liberado, index) in liberados" :key="liberado.id">
							<td>{{index+1}}</td>
							<td>{{liberado.dni}}</td>
							<td class="text-capitalize"><a :href="'liberado-perfil.php?id='+liberado.id" class="text-decoration-none">{{liberado.apellidos}} {{liberado.nombres}}</a></td>
							<td>{{liberado.celular}}</td>
							<td><button class="btn btn-outline-danger btn-sm" @click="eliminar(index)"><i class="bi bi-x"></i></button></td>
						</tr>
					</tbody>
				</table>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const liberados = ref([])
			const filtro = ref({dni: '', nombres: ''})

			onMounted(()=>{
				axios.get(servidor+'liberados')
				.then(response=>{
					liberados.value = response.data
				})
			})

			function buscar(index, id){
				axios.post(servidor+'buscarLiberado', {
					dni: filtro.value.dni, nombres: filtro.value.nombres
				}).then(response=>{
					liberados.value = response.data
				})
			}

			function eliminar(index){
				if(confirm(`¿Estás seguro de eliminar este liberado ${liberados.value[index].apellidos} ${liberados.value[index].nombres}?`)){
					axios.delete(servidor+'liberados/'+liberados.value[index].id)
					.then(response=>{
						liberados.value.splice(index, 1)
					})
				}
			}

			return {
				liberados, eliminar, filtro, buscar
			}
		}
	}).mount('#app')
</script>
</body>
</html>