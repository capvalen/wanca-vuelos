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
			<?php $titulo_pagina= "Registro de paquete de cliente";
			include 'menu_usuario.php'; ?>

			<div class="row">
				<div class="col-6">
					<label for="">Nombre del paquete</label>
					<input type="text" class="form-control" v-model="paquete.paquete">
				</div>
				<div class="col-6">
					<label for="">Destino</label>
					<select name="" id="" class="form-select" v-model="paquete.destino_id">
						<option v-for="destino in destinos" :value="destino.id">{{destino.destino}}</option>
					</select>
				</div>
				<div class="col-6">
					<label for="">Fecha de salida</label>
					<input type="date" class="form-control" v-model="paquete.salida">
				</div>
				<div class="col-6">
					<label for="">Fecha de regreso</label>
					<input type="date" class="form-control" v-model="paquete.regreso">
				</div>
				<div class="col-6">
					<label for="">Moneda</label>
					<select name="" id="" class="form-select" v-model="paquete.moneda_id">
						<option v-for="moneda in monedas" :value="moneda.id">{{moneda.moneda}}</option>
					</select>
				</div>

				<div class="col-6">
					<label for="">Costo del paquete</label>
					<input type="number" class="form-control" v-model="paquete.costo" v-model="paquete.motivo" @change="cambiarFinal()" @keyup="cambiarFinal()">
				</div>
				<div class="col-6">
					<label for="">Costo adicional</label>
					<input type="number" class="form-control" v-model="paquete.adicional" @change="cambiarFinal()" @keyup="cambiarFinal()">
				</div>
				<div class="col-6">
					<label for="">Motivo del adicional</label>
					<input type="text" class="form-control" v-model="paquete.motivo">
				</div>
				<div class="col-6">
					<label for="">Datos extras</label>
					<input type="text" class="form-control" v-model="paquete.observaciones">
				</div>

				
				<div class="col-6">
					<p class="fs-5">Total a pagar final: <strong>
						<span v-if="paquete.moneda_id==1">S/ </span> 
						<span v-if="paquete.moneda_id==2">$ </span> 
						<span>{{parseFloat(paquete.precio).toFixed(2)}}</span>
					</strong></p>
				</div>
				<div class="col-6 d-grid">
					<button class="btn btn-success" @click="guardar()"><i class="bi bi-floppy"></i> Guardar paquete</button>
				</div>

			</div>
		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const idCliente = ref([])
			const destinos = ref([])
			const monedas = ref([])
			const paquete = ref({
				paquete:'', costo:0, adicional:0, precio:0, motivo:'', observaciones:'', destino_id:1, moneda_id:1, client_id:-1, salida:null, regreso:null
			})
			const servidor = '<?= $api ?>'

			onMounted(()=>{
				const urlParams = new URLSearchParams(window.location.search);
				idCliente.value = urlParams.get('id');

				paquete.value.client_id = idCliente.value

				axios.get(servidor+'destinos').then(response=> destinos.value = response.data)
				axios.get(servidor+'monedas').then(response=> monedas.value = response.data)
			})

			function guardar(){
				axios.post(servidor+'paquetes', paquete.value)
				.then(resp=>{
					if(resp.data.id) window.location = 'paquete-detalle.php?id='+resp.data.id
				})
			}

			function cambiarFinal(){
				paquete.value.costo = parseFloat(paquete.value.costo || 0)
				paquete.value.adicional = parseFloat(paquete.value.adicional || 0)
				return paquete.value.precio = (parseFloat(paquete.value.costo ) + parseFloat(paquete.value.adicional )) 
			}

			function fechaLatam(fecha){
				if(fecha)
					return moment(fecha).format('DD/MM/YYYY');
			}

			return {
				idCliente, destinos, monedas, paquete,
				cambiarFinal, guardar, fechaLatam
			}
		}
	}).mount('#app')
</script>
<style scoped>
	label{font-weight: bold; color:#323232;}
</style>
</body>
</html>