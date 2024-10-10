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
			<a href="liberado-nuevo.php" class="btn btn-outline-success btn-sm"><i class="bi bi-asterisk"></i> Crear nuevo liberado</a>
			<p>Los últimos 50 liberados</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Apellidos y nombres</th>
					<th>D.N.I.</th>
					<th>Contacto</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr>
							<td>1</td>
							<td><a href="liberado-perfil.php?id=6" class="text-decoration-none">García López, Juan</a></td>
							<td>12345678</td>
							<td>950-850111</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg"></i></button></td>
					</tr>
					<tr>
							<td>2</td>
							<td><a href="liberado-perfil.php?id=6" class="text-decoration-none">Martínez Pérez, Ana</a></td>
							<td>87654321</td>
							<td>25-2601</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg"></i></button></td>
					</tr>
					<tr>
							<td>4</td>
							<td><a href="liberado-perfil.php?id=6" class="text-decoration-none">Rodríguez Gómez, María</a></td>
							<td>44332211</td>
							<td>95145581</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x-lg"></i></button></td>
					</tr>
				</tbody>


			</table>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref } = Vue

	createApp({
		setup() {
			const message = ref('Hello vue!')
			return {
				message
			}
		}
	}).mount('#app')
</script>
</body>
</html>