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
			<?php  $titulo_pagina = "Sección aportaciones";
			include 'menu_usuario.php'; ?>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<label for=""><i class="bi bi-funnel"></i> Cliente</label>
							<input type="text" class="form-control" >
						</div>
						<div class="col-4">
							<label for=""><i class="bi bi-funnel"></i> Paquete</label>
							<input type="text" class="form-control" >
						</div>
						<div class="col-4">
							<label for="">Fecha del paquete</label>
							<input type="date" class="form-control" value="2024-12-09">
						</div>
					</div>
				</div>
			</div>
			<div class="my-2 d-flex justify-content-end">
				<div class="btn btn-outline-secondary btn-sm"><i class="bi bi-funnel"></i> Filtrar</div>
			</div>

			<p>Listado de paquetes asociados</p>
			<table class="table table-hover">
				<thead>
					<th>N°</th>
					<th>Cliente</th>
					<th>Nombre de paquete</th>
					<th>Costo final</th>
					<th>Fecha de salida</th>
					<th>N° participantes</th>
					<th>N° liberados</th>
					<th>@</th>
				</thead>
				<tbody>
					<tr>
							<td>1</td>
							<td><a class="text-decoration-none" href="cliente-perfil.php?id=2">Colegio Zarate</a></td>
							<td><a href="paquete-detalle.php?id=6" class="text-decoration-none">Aventura en los Alpes</a></td>
							<td>$1,200</td>
							<td>15/11/2024</td>
							<td>20</td>
							<td>5</td>
							<td>
								<a href="aportacion-paquete.php?id=36" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Aportación</a>
							</td>
					</tr>
					<tr>
							<td>2</td>
							<td><a class="text-decoration-none" href="cliente-perfil.php?id=2">Colegio La asunción</a></td>
							<td><a href="paquete-detalle.php?id=6" class="text-decoration-none">Safari en Kenia</a></td>
							<td>$2,500</td>
							<td>01/12/2024</td>
							<td>15</td>
							<td>3</td>
							<td>
								<a href="aportacion-paquete.php?id=36" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Aportación</a>
							</td>
					</tr>
					<tr>
							<td>3</td>
							<td><a class="text-decoration-none" href="cliente-perfil.php?id=2">Instituto Dominicano Redentor</a></td>
							<td><a href="paquete-detalle.php?id=6" class="text-decoration-none">Tour por las Pirámides</a></td>
							<td>$1,800</td>
							<td>20/12/2024</td>
							<td>25</td>
							<td>10</td>
							<td>
								<a href="aportacion-paquete.php?id=36" class="btn btn-sm btn-outline-primary"><i class="bi bi-plus"></i> Aportación</a>
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