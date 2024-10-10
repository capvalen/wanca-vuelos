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
			<a href="participante-nuevo.php" class="btn btn-outline-success btn-sm"><i class="bi bi-asterisk"></i> Crear nuevo participante</a>
			<p>Los últimos 50 participantes</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Apellidos y nombres</th>
					<th>D.N.I.</th>
					<th>Padres</th>
					<th>Contacto</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr>
							<td>1</td>
							<td><a href="participante-perfil.php?id=6" class="text-decoration-none">García López, Juan</a></td>
							<td>12345678</td>
							<td>
								<p>María López</p>
								<p>Pedro García</p>
							</td>
							<td>juan.garcia@example.com</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button></td>
					</tr>
					<tr>
							<td>2</td>
							<td><a href="participante-perfil.php?id=6" class="text-decoration-none">Martínez Pérez, Ana</a></td>
							<td>87654321</td>
							<td><p>Laura Pérez</p> <p>Carlos Martínez</p></td>
							<td>ana.martinez@example.com</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button></td>
					</tr>
					<tr>
							<td>3</td>
							<td><a href="participante-perfil.php?id=6" class="text-decoration-none">Fernandez Miguel, Carlos</a></td>
							<td>11223344</td>
							<td><p>Elena Ruiz</p> <p>Miguel Fernández</p></td>
							<td>luis.fernandez@example.com</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button></td>
					</tr>
					<tr>
							<td>4</td>
							<td><a href="participante-perfil.php?id=6" class="text-decoration-none">Rodríguez Gómez, María</a></td>
							<td>44332211</td>
							<td><p>Isabel Gómez</p> <p>José Rodríguez</p></td>
							<td>maria.rodriguez@example.com</td>
							<td><button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button></td>
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