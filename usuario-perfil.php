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
			<?php  $titulo_pagina = "Editar perfil";
			include 'menu_usuario.php'; ?>

			<div class="card">
				<div class="card-body">
					<h2>Información del usuario: {{usuario.paterno}} {{usuario.materno}} {{usuario.name}}</h2>
					<div class="formulario-restaurant row row-cols-2">
						<div v-for="(valor, campo) in usuario" :key="campo" class="col">
							<label :for="campo" class="text-capitalize">
									<template v-if="campo === 'paterno'">Apellido paterno:</template>
									<template v-else-if="campo === 'materno'">Apellido materno:</template>
									<template v-else-if="campo === 'name'">Nombres:</template>
									<template v-else>{{ campo.replaceAll('_', ' ') }}:</template>
							</label>
							
							<!-- Input para moneda con opciones -->
							<select v-if="campo === 'nivel'" :id="campo" class="form-select" v-model="usuario[campo]" disabled>
								<option value="1">Administrador</option>
								<option value="2">Colaborador</option>
							</select>
					
							<!-- Input para campos de texto normales -->
							<input v-else
								type="text"
								class="form-control"
								:id="campo"
								v-model="usuario[campo]"
								:disabled="campo === 'paterno' || campo === 'materno' || campo === 'name' || campo === 'usuario'"
							>
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-center align-items-center my-3" @click="actualizar()"><button class="btn btn-outline-success btn-lg py-2"><i class="bi bi-arrow-clockwise"></i> Actualizar datos</button></div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const idUsuario = ref(-1)
			const usuario=ref({
					paterno:'',
					materno:'',
					name:'',
					nick:'',
					correo:'',
					clave:'',
					celular:'',
					direccion:'', password:''
				})

			onMounted(()=>{
				// Obtener el ID de la URL si existe
				const urlParams = new URLSearchParams(window.location.search);
				const idFromUrl = urlParams.get('id');
				
				if(localStorage.getItem('nivel')==1)
					idUsuario.value = idFromUrl || localStorage.getItem('idUsuario');
				else idUsuario.value =localStorage.getItem('idUsuario')
				
				//const id = idFromUrl || localStorage.getItem('idUsuario');

				axios.get(servidor+'usuarios/'+idUsuario.value)
				.then(response=>{
					usuario.value = response.data
					delete usuario.value.id
					delete usuario.value.nick
					delete usuario.value.created_at
					delete usuario.value.updated_at
					if(localStorage.getItem('nivel')==1){
						usuario.value.password = ''
					}
				})
			})

			function actualizar(){
				const id = localStorage.getItem('idUsuario')
				axios.put(servidor+'usuarios/'+idUsuario.value, usuario.value)
				.then(resp=> alert('Datos actualizados correctamente'))
			}

			return {
				usuario, actualizar, idUsuario
			}
		}
	}).mount('#app')
</script>
</body>
</html>