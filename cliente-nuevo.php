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
			<?php  $titulo_pagina = "Registro de cliente nuevo";
			include 'menu_usuario.php'; ?>
			<div class="row">
				<div class="col-6">
					<label for="">R.U.C. / D.N.I.</label>
					<input type="text" class="form-control" v-model="cliente.ruc">
				</div>
				<div class="col-6">
					<label for="">Razón social / Nombres</label>
					<input type="text" class="form-control" v-model="cliente.razon">
				</div>
				<div class="col-12">
					<label for="">Datos adicionales</label>
					<input type="text" class="form-control" v-model="cliente.observaciones">
				</div>
			</div>
			<div class="row d-none">
				<div class="col-12">
					<label for=""><small>Indicar ciudades</small></label>
					<div class="row">
						<div class="col">
							<label for="">Ciudad</label>
							<select name="" id="" class="form-select">
								<option value="1">Lima</option>
								<option value="2">Huancayo</option>
							</select>
						</div>
						<div class="col d-flex align-items-center">
							<button class="btn btn-outline-secondary"><i class="bi bi-plus-lg"></i> Agregar ciudad</button>
						</div>
					</div>

					<ol class="list-group list-group-numbered">
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>La merced</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>San Ramón</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<div>Huancayo</div>
							</div>
							<span class="badge text-bg-danger rounded-pill puntero"><i class="bi bi-x"></i></span>
						</li>
					</ol>
				</div>

			
			</div>
			<div class="row">
				<div class="col">
					<div class="d-flex mt-2 justify-content-center">
						<button class="btn btn-primary" @click="guardar()"><i class="bi bi-floppy"></i> Guardar cliente</button>
					</div>
				</div>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref } = Vue

	createApp({
		setup() {
			const cliente = ref({
				ruc:'', razon:'', observaciones:''
			})
			const servidor = '<?= $api ?>'
			
			function guardar(){
				axios.post(servidor+'clients', cliente.value)
				.then(resp=>{
					if(resp.data.id) window.location = 'cliente-perfil.php?id='+resp.data.id
				})
			}

			return {
				cliente, guardar
			}
		}
	}).mount('#app')
</script>
</body>
</html>