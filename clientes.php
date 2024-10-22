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
							<input type="text" class="form-control" >
						</div>
						<div class="col">
							<label for=""><i class="bi bi-funnel"></i> Nombres / Razón social</label>
							<input type="text" class="form-control" >
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between">
				<div class="gap-2">
					<a href="cliente-nuevo.php" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-person-circle"></i> Nuevo cliente</a>
				</div>
				<button class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i> Filtrar</button>
			</div>

			<section class="mt-3" id="resultados">
				<p>Los 50 últimos clientes registrados:</p>
				<table class="table table-hover">
					<thead>
						<th>N°</th>
						<th>DNI/RUC</th>
						<th>Cliente</th>
						<th>@</th>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>60234884</td>
							<td><a href="cliente-perfil.php?id=2" class="text-decoration-none">Juan Pérez</a></td>
							<td>
								<a href="cliente-paquete-nuevo.php?id=90" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-asterisk"></i> Nuevo paquete</a>
								<button class="btn btn-outline-danger me-1"><i class="bi bi-eraser"></i> Eliminar</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>102060234884</td>
							<td><a href="cliente-perfil.php?id=2" class="text-decoration-none">Banco de Crédito</a></td>
							<td>
								<a href="cliente-paquete-nuevo.php?id=90" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-asterisk"></i> Nuevo paquete</a>
								<button class="btn btn-outline-danger me-1"><i class="bi bi-eraser"></i> Eliminar</button>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>14256300</td>
							<td><a href="cliente-perfil.php?id=2" class="text-decoration-none">Carlos López</a></td>
							<td class="">
								<a href="cliente-paquete-nuevo.php?id=90" class="btn btn-sm btn-outline-success me-1"><i class="bi bi-asterisk"></i> Nuevo paquete</a>
								<button class="btn btn-outline-danger me-1"><i class="bi bi-eraser"></i> Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>
		</section>

		</article>

		
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