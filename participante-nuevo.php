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
			<?php  $titulo_pagina = "Crear nuevo participante";
			include 'menu_usuario.php'; ?>
			<div class="card">
				<div class="card-body">
					<label for=""><small>Datos personales</small></label>
					<div class="row">
						<div class="col-md-4">
							<label for="">Apellidos</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.apellidos">
						</div>
						<div class="col-md-4">
							<label for="">Nombres</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.nombres">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset">
							<label for="">D.N.I.</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.dni">
						</div>
						<div class="col-md-4 offset">
							<label for="">Fecha caducidad DNI</label>
							<input type="date" class="form-control" autocomplete="off" v-model="participante.caducidad">
						</div>
						<div class="col-md-4 offset">
							<label for="">N° pasaporte</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.pasaporte">
						</div>
					</div>
				</div>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<label for=""><small>Datos de Contacto</small></label>
					<div class="row">
						<div class="col-md-4 ">
							<label for="">Celular de contacto</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.celular">
						</div>
						<div class="col-md-4 ">
							<label for="">Ficha de inscripción</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.ficha">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="col-md-4 ">
							<label for="">Acuerdo de pago firmado</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.acuerdo">
								<option value="1">Si</option>
								<option value="0" select>No</option>
							</select>
							
						</div>
						<div class="col-md-4">
							<label for="">Copia de DNI del papá</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.copia_papa">
								<option value="1">Si</option>
								<option value="0" selected>No</option>
							</select>
							
						</div>
						<div class="col-md-4">
							<label for="">Copia de DNI de la mamá</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.copia_mama">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="col-md-12">
							<label for="">Dirección de domicilio actual</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.direccion">
						</div>
						<div class="col-md-12">
							<label for="">Anotaciones adicionales</label>
							<input type="text" class="form-control" autocomplete="off" v-model="participante.observaciones">
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg" @click="guardar()"><i class="bi bi-asterisk"></i> Crear nuevo participante</button>
			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref } = Vue

	createApp({
		setup() {
			const participante = ref({
				apellidos: '',
				nombres: '',
				dni: '',
				caducidad: '',
				celular: '',
				ficha: 0,
				acuerdo: 0,
				copia_papa: 0,
				copia_mama: 0,
				direccion: '',
				pasaporte: '',
				observaciones: ''
			})
			const servidor = '<?= $api ?>'

			function guardar(){
				axios.post(servidor+'participantes', participante.value)
				.then(resp=>{
					if(resp.data.id) window.location = 'participante-perfil.php?id='+resp.data.id
				})
			}
			return {
				participante, guardar
			}
		}
	}).mount('#app')
</script>
</body>
</html>