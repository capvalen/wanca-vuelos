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
			<?php  $titulo_pagina = "Nuevo liberado";
			include 'menu_usuario.php'; ?>
			<div class="card">
				<div class="card-body">
					<label for=""><small>Datos personales</small></label>
					<div class="row">
						<div class="col-md-4">
							<label for="">Apellidos</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.apellidos">
						</div>
						<div class="col-md-4">
							<label for="">Nombres</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.nombres">
						</div>
						<div class="col-md-4">
							<label for="">Relación con los participantes</label>
							<select name="" id="" class="form-select mb-0" v-model="liberado.relacion_id">
								<option v-for="relacion in relaciones" :value="relacion.id">{{relacion.relacion}}</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset">
							<label for="">D.N.I.</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.dni">
						</div>
						<div class="col-md-4 offset">
							<label for="">Fecha caducidad DNI</label>
							<input type="date" class="form-control" autocomplete="off" v-model="liberado.caducidad">
						</div>
						<div class="col-md-4 ">
							<label for="">Celular</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.cellular">
						</div>
						<div class="col-md-12">
							<label for="">Dirección de domicilio actual</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.direccion">
						</div>						
					</div>
				</div>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<label for=""><small>Datos de adicionales</small></label>
					<div class="row">
						<div class="col-md-4 ">
							<label for="">Ficha de inscripción</label>
							<select name="" id="" class="form-select mb-0" v-model="liberado.ficha">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>
						<div class="col-md-4 ">
							<label for="">Acuerdo de pago firmado</label>
							<select name="" id="" class="form-select mb-0" v-model="liberado.acuerdo">
								<option value="1">Si</option>
								<option value="0" select>No</option>
							</select>
						</div>
						<div class="col-md-4 ">
							<label for="">N° de pasaporte</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.pasaporte">
						</div>
						<div class="col-md-12">
							<label for="">Anotaciones adicionales</label>
							<input type="text" class="form-control" autocomplete="off" v-model="liberado.observaciones">
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg" @click="guardar"><i class="bi bi-asterisk"></i> Crear liberado</button>
			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const liberado = ref({
				apellidos: '',
				nombres: '',
				dni: '',
				caducidad: '',
				relacion_id: 1,
				direccion: '',
				celular: '',
				ficha: 0,
				acuerdo: 0,
				pasaporte: '',
				observaciones: ''
			})
			const relaciones = ref([])

			onMounted(()=>{
				axios.get(servidor+'relaciones').then(response=>{ relaciones.value = response.data })
			})

			function guardar(){
				axios.post(servidor+'liberados', liberado.value)
				.then(resp=>{
					if(resp.data.id) window.location = 'liberado-perfil.php?id='+resp.data.id
				})
			}

			return {
				liberado, relaciones, guardar
			}
		}
	}).mount('#app')
</script>
</body>
</html>