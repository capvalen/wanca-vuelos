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
			<?php  $titulo_pagina = "Detalle de liberado";
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
							<input type="text" class="form-control" autocomplete="off"v-model="liberado.celular">
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
							<select name="" id="" class="form-select mb-0" v-model="liberado.ficha" @change="actualizarFechaFicha">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
							<p v-if="liberado.fecha_ficha && liberado.ficha == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(liberado.fecha_ficha)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
						<div class="col-md-4 ">
							<label for="">Acuerdo de pago firmado</label>
							<select name="" id="" class="form-select mb-0" v-model="liberado.acuerdo" @change="actualizarFechaAcuerdo">
								<option value="1">Si</option>
								<option value="0" select>No</option>
							</select>
							<p v-if="liberado.fecha_acuerdo && liberado.acuerdo == 1"><i class="bi bi-arrow-right"></i> Entregado {{fechaLatam(liberado.fecha_acuerdo)}}</p>
							<p v-else><i class="bi bi-arrow-right"></i> No entregado</p>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg" @click="actualizar()"><i class="bi bi-arrow-clockwise"></i> Actualizar datos</button>
			</div>

			<div class="card my-2">
				<div class="card-body">
					<p><strong>Lista de Tours asociados al liberado</strong></p>
					<table class="table table-hover">
						<thead>
							<th>N°</th>
							<th>Tour</th>
							<th>Entidad</th>
							<th>Fecha</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Visita guiada a museo</td>
								<td>Colegio Santa Rosa</td>
								<td>14/05/2025</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Tour selvático</td>
								<td>Comitiva San Jose</td>
								<td>06/01/2024</td>
								</tr>
						</tbody>

					</table>
				</div>
			</div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const liberado = ref([])
			const relaciones = ref([])
			const idLiberado = ref(-1)

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idLiberado.value = urlParams.get('id');

				axios.get(servidor+'relaciones').then(response=>{ relaciones.value = response.data })
				axios.get(servidor+'liberados/'+idLiberado.value).then(response=>{ liberado.value = response.data })
			})

			function actualizar(){
				axios.put(servidor+'liberados/'+idLiberado.value, liberado.value)
				.then(resp=>{
					//if(resp.data.id) location.reload()
					alert('Datos actualizados')
				})
			}

			function actualizarFechaFicha(){
				liberado.value.fecha_ficha = liberado.value.ficha ==1 ? moment().format('YYYY-MM-DD') : null;
			}
			function actualizarFechaAcuerdo(){
				liberado.value.fecha_acuerdo = liberado.value.acuerdo ==1 ? moment().format('YYYY-MM-DD') : null;
			}
			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				liberado, idLiberado, relaciones, actualizar, actualizarFechaFicha, actualizarFechaAcuerdo, fechaLatam
			}
		}
	}).mount('#app')
</script>
</body>
</html>