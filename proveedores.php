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
					<th>Concepto</th>
					<th>Ciudad</th>
					<th>Servicio</th>
					<th>Fecha de servicio</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr>
							<td>1</td>
							<td>Buffet amazónico</td>
							<td>La merced</td>
							<td>Restaurant</td>
							<td>2023-11-22</td>
							<td>
								<button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></button>
								<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
							</td>
					</tr>
					<tr>
							<td>2</td>
							<td>Venta de productos lácteos</td>
							<td>Huancayo</td>
							<td>Comestibles</td>
							<td>2023-12-05</td>
							<td>
								<button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></button>
								<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
							</td>
					</tr>
					<tr>
							<td>3</td>
							<td>Clase de yoga</td>
							<td>Lima</td>
							<td>Clases</td>
							<td>2023-11-30</td>
							<td>
								<button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></button>
								<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
							</td>
					</tr>
					<tr>
							<td>4</td>
							<td>Corte de cabello</td>
							<td>Mendoza</td>
							<td>Estilista</td>
							<td>2023-12-10</td>
							<td>
								<button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-square"></i></button>
								<button class="btn btn-outline-danger btn-sm"><i class="bi bi-x"></i></button>
							</td>
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