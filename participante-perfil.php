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
			<?php  $titulo_pagina = "Detalle de participante";
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
							<label for="">N° pasaporte.</label>
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
							<select name="" id="" class="form-select mb-0" v-model="participante.ficha" @change="actualizarFechaFicha">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
							<p v-if="participante.fecha_ficha && participante.ficha == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(participante.fecha_ficha)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
						<div class="col-md-4 ">
							<label for="">Acuerdo de pago firmado</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.acuerdo" @change="actualizarFechaAcuerdo">
								<option value="1">Si</option>
								<option value="0" >No</option>
							</select>
							<p v-if="participante.fecha_acuerdo && participante.acuerdo == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(participante.fecha_acuerdo)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
						<div class="col-md-4">
							<label for="">Copia de DNI del papá</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.copia_papa" @change="actualizarFechaPapa">
								<option value="1">Si</option>
								<option value="0" >No</option>
							</select>
							<p v-if="participante.fecha_copia_papa && participante.copia_papa == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(participante.fecha_copia_papa)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
						<div class="col-md-4">
							<label for="">Copia de DNI de la mamá</label>
							<select name="" id="" class="form-select mb-0" v-model="participante.copia_mama" @change="actualizarFechaMama">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
							<p v-if="participante.fecha_copia_mama && participante.copia_mama == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(participante.fecha_copia_mama)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
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
				<button class="btn btn-primary btn-lg" @click="actualizar()"><i class="bi bi-arrow-clockwise"></i> Actualizar datos</button>
			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const participante = ref([])
			const servidor = '<?= $api ?>'
			const idParticipante = ref(-1)

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idParticipante.value = urlParams.get('id');


				axios.get(servidor+'participantes/'+idParticipante.value)
				.then(response=>{
					participante.value = response.data
				})
			})

			function actualizar(){
				axios.put(servidor+'participantes/'+idParticipante.value, participante.value)
				.then(resp=>{
					//if(resp.data.id) location.reload()
					alert('Datos  actualizados')
				})
			}

			function actualizarFechaFicha(){
				participante.value.fecha_ficha = participante.value.ficha ==1 ? moment().format('YYYY-MM-DD') : null;
			}
			function actualizarFechaAcuerdo(){
				participante.value.fecha_acuerdo = participante.value.acuerdo ==1 ? moment().format('YYYY-MM-DD') : null;
			}
			function actualizarFechaPapa(){
				participante.value.fecha_copia_papa = participante.value.copia_papa ==1 ? moment().format('YYYY-MM-DD') : null;
			}
			function actualizarFechaMama(){
				participante.value.fecha_copia_mama = participante.value.copia_mama ==1 ? moment().format('YYYY-MM-DD') : null;
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				participante, idParticipante, actualizar,
				fechaLatam, actualizarFechaFicha, actualizarFechaAcuerdo, actualizarFechaPapa, actualizarFechaMama
			}
		}
	}).mount('#app')
</script>
</body>
</html>