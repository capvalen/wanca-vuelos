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
			<?php  $titulo_pagina = "Sección participantes";
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
				<a href="participante-nuevo.php" class="btn btn-outline-success btn-sm"><i class="bi bi-asterisk"></i> Crear nuevo participante</a>
				<button class="btn btn-sm btn-outline-secondary" @click="buscar()"><i class="bi bi-search"></i> Filtrar</button>
			</div>

			
			<div class="resultados mt-3">
				<p>Los últimos 50 participantes</p>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>D.N.I.</th>
						<th>Apellidos y nombres</th>
						<th>Padres</th>
						<th>Contacto</th>
						<th>@</th>
					</thead>
					<tbody>
						<tr v-for="(participante, index) in participantes" :key="participante.id">
							<td>{{index+1}}</td>
							<td>{{participante.dni}}</td>
							<td class="text-capitalize"><a :href="'participante-perfil.php?id='+participante.id" class="text-decoration-none">{{participante.apellidos}} {{participante.nombres}}</a></td>
							<td>
								<p>María López</p>
								<p>Pedro García</p>
							</td>
							<td>{{participante.celular}}</td>
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
			const participantes = ref([])
			const filtro = ref({ dni: null, nombres: null })

			onMounted(()=>{
				axios.get(servidor+'participantes')
				.then(response=>{
					participantes.value = response.data
				})
			})

			function buscar(index, id){
				axios.post(servidor+'filtrarParticipante', {
					dni: filtro.value.dni, nombres: filtro.value.nombres
				}).then(response=>{
					participantes.value = response.data
				})
			}

			function eliminar(index){
				if(confirm(`¿Estás seguro de eliminar este participante ${participantes.value[index].apellidos} ${participantes.value[index].nombres}?`)){
					axios.delete(servidor+'participantes/'+participantes.value[index].id)
					.then(response=>{
						participantes.value.splice(index, 1)
					})
				}
			}

			return {
				participantes, eliminar, filtro, buscar
			}
		}
	}).mount('#app')
</script>
</body>
</html>