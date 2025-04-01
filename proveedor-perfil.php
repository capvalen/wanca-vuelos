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
							<select name="" id="" class="form-select mb-0" v-model="proveedor.servicio_id" @change="cambiarServicio()">
								<option v-for="servicio in servicios" :value="servicio.id">{{servicio.servicio}}</option>
							</select>
						</div>
						<div class="col-md-4 d-none">
							<label for="">Fecha inicio</label>
							<input type="date" class="form-control" autocomplete="off"  v-model="proveedor.inicio">
						</div>
						<div class="col-md-4 d-none">
							<label for="">Fecha final</label>
							<input type="date" class="form-control" autocomplete="off"  v-model="proveedor.final">
						</div>
						
						<div class="col-md-4">
							<label for="">Contacto</label>
							<input type="text" class="form-control" autocomplete="off"  v-model="proveedor.contacto">
						</div>
						<div class="col-md-4">
							<label for="">Dato extra (ruta)</label>
							<input type="text" class="form-control" autocomplete="off" v-model="proveedor.observaciones">
						</div>
					</div>
					
				</div>
			</div>

		
			
			<div class="card mt-3">
				<div class="card-body">
					<div class="formulario-restaurant">
						<h2>Información adicional: {{proveedor.servicio_nombre}}</h2>
						
						<div v-for="(valor, campo) in proveedor.detalles" :key="campo" >
							<label :for="campo" class="text-capitalize">{{ campo.replaceAll('_', ' ') }}:</label>
							<!-- Input para moneda con opciones -->
							<select v-if="campo === 'moneda'" :id="campo" class="form-select" v-model="proveedor.detalles[campo]">
								<option value="soles">Soles</option>
								<option value="dolares">Dólares</option>
							</select>
							
							<!-- Input para campos numéricos -->
							<input 
								v-else-if="esNumerico(campo)" 
								type="number" 
								class="form-control"
								:id="campo" 
								v-model.number="proveedor.detalles[campo]"
								step="0.01"
							>
							
							<!-- Input para campos de texto normales -->
							<input 
								v-else 
								type="text" 
								class="form-control"
								:id="campo" 
								v-model="proveedor.detalles[campo]"
							>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-center mt-3">
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
			const servicioSeleccionado=ref('')
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
			const detalles = ref({
				'Restaurant':{ banco: '', num_cuenta: '', moneda: '', titular: '', costo_desayuno: 0, costo_almuerzo: 0, costo_cena: 0},
				'Hotel':{ banco: '', num_cuenta: '', moneda: '', titular: '', costo_noche: 0, costo_desayuno: 0, costo_cena: 0, costo_particular: 0, costo_simple: 0, costo_doble:0, costo_triple: 0, costo_cuadruple: 0},
				'Transporte interprovincial':{ banco: '', num_cuenta: '', moneda: '', titular: '', ruta:''},
				'Transporte turístico':{ banco: '', num_cuenta: '', moneda: '', titular: ''},
				'Avión':{ banco: '', num_cuenta: '', moneda: '', titular: '', costo_maleta_nacional:'', costo_maleta_internacional:''},
				'Tren':{ banco: '', num_cuenta: '', moneda: '', titular: '', ruta:''},
				'Guía':{ banco: '', num_cuenta: '', moneda: '', titular: ''},
				'Sitio turístico':{ banco: '', num_cuenta: '', moneda: '', titular: '', costo_estudiante:'', costo_adulto:'', costo_profesor:''},
				'Seguro de viaje':{ banco: '', num_cuenta: '', moneda: '', titular: '', cobertura:''},
				'TC agencia':{ banco: '', num_cuenta: '', moneda: '', titular: ''},
				'Otro': { banco: '', num_cuenta: '', moneda: '', titular: ''},
				'Agencia mayorista':{ banco: '', num_cuenta: '', moneda: '', titular: ''},
				'Bote':{ banco: '', num_cuenta: '', moneda: '', titular: '', recorrido:''}
			})

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idProveedor.value = urlParams.get('id');

				axios.get(servidor+'servicios').then(response=>{ servicios.value = response.data })
				axios.get(servidor+'destinos').then(response=>{ destinos.value = response.data })
				axios.get(servidor+'conceptos').then(response=>{ conceptos.value = response.data })
				axios.get(servidor+'proveedores/'+idProveedor.value).then(response=>{					
					proveedor.value = response.data
					if(proveedor.value.detalles?.length==0 || !proveedor.value.detalles) proveedor.value.detalles = detalles.value[proveedor.value.servicio_nombre]
				})
				
			})

			function actualizar(){
				axios.put(servidor+'proveedores/'+idProveedor.value, proveedor.value)
				.then(resp=>{
					//if(resp.data.id) location.reload()
					alert('Proveedor actualizado')
				})
			}
			const esNumerico = (campo) => {
				return campo.startsWith('costo_');
			};

			function cambiarServicio(){
				const servicio = servicios.value.find(x=> x.id == proveedor.value.servicio_id);
				proveedor.value.servicio_nombre = servicio.servicio
				proveedor.value.detalles = detalles.value[servicio.servicio]
			}

			return {
				proveedor, servicios, destinos, conceptos, actualizar, detalles, esNumerico,cambiarServicio
			}
		}
	}).mount('#app')
</script>
</body>
</html>