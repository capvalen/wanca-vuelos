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
			<?php  $titulo_pagina = "Nuevo provedor";
			include 'menu_usuario.php'; ?>
			<div class="card my-2">
				<div class="card-body">
					<label for=""><small>Datos generales</small></label>
					<div class="row">
						<div class="col-md-4">
							<label for="">Nombre opcional del proveedor</label>
							<input type="text" class="form-control" autocomplete="off"  v-model="proveedor.nombre">
						</div>
						<div class="col-md-4">
							<label for="">Concepto</label>
							<select name="" id="" class="form-select mb-0" v-model="proveedor.concepto_id">
							<option v-for="concepto in conceptos" :value="concepto.id">{{concepto.concepto}}</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Ciudad</label>
							<select name="" id="" class="form-select mb-0" v-model="proveedor.destino_id">
								<option v-for="destino in destinos" :value="destino.id">{{destino.destino}}</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Servicios</label>
							<select name="" id="" class="form-select mb-0" v-model="proveedor.servicio_id">
								<option v-for="servicio in servicios" :value="servicio.id">{{servicio.servicio}}</option>
							</select>
						</div>
						<div class="col-md-4">
							<label for="">Fecha inicio</label>
							<input type="date" class="form-control" autocomplete="off"  v-model="proveedor.inicio">
						</div>
						<div class="col-md-4">
							<label for="">Fecha final</label>
							<input type="date" class="form-control" autocomplete="off"  v-model="proveedor.final">
						</div>
						
						<div class="col-md-4">
							<label for="">Contacto</label>
							<input type="text" class="form-control" autocomplete="off"  v-model="proveedor.contacto">
						</div>
						<div class="col-md-4">
							<label for="">Dato extra</label>
							<input type="text" class="form-control" autocomplete="off" v-model="proveedor.observaciones">
						</div>
					</div>
					
				</div>
			</div>

			<div class="d-flex justify-content-center">
				<button class="btn btn-primary btn-lg" @click="actualizar"><i class="bi bi-asterisk"></i> Actualizar proveedor</button>
			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const idProveedor = ref(-1)
			const proveedor = ref({
				nombre: '',
				destino_id: 1,
				servicio_id: 1,
				concepto_id: 1,
				inicio: '',
				final: '',
				contacto: '',
				observaciones: ''
			})
			const servicios = ref([])
			const destinos = ref([])
			const conceptos = ref([])

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idProveedor.value = urlParams.get('id');

				axios.get(servidor+'servicios').then(response=>{ servicios.value = response.data })
				axios.get(servidor+'destinos').then(response=>{ destinos.value = response.data })
				axios.get(servidor+'conceptos').then(response=>{ conceptos.value = response.data })
				axios.get(servidor+'proveedores/'+idProveedor.value).then(response=>{ proveedor.value = response.data })
			})

			function actualizar(){
				axios.put(servidor+'proveedores/'+idProveedor.value, proveedor.value)
				.then(resp=>{
					//if(resp.data.id) location.reload()
					alert('Proveedor actualizado')
				})
			}

			return {
				proveedor, servicios, destinos, conceptos, actualizar
			}
		}
	}).mount('#app')
</script>
</body>
</html>