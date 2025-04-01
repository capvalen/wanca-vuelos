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
			<?php  $titulo_pagina = "Creación de nuevo usuario";
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
							
							<select v-if="campo === 'nivel'" :id="campo" class="form-select" v-model="usuario[campo]" >
								<option value="1">Administrador</option>
								<option value="2">Colaborador</option>
							</select>
					
							<input
								type="text"
								class="form-control complejo"
								:id="campo"
								v-model="usuario[campo]"								
								@keyup="generar" v-else-if="campo == 'paterno' || campo == 'materno' || campo == 'name'"
								autocomplete="off"
							>
							<input v-else
								type="text"
								class="form-control simple"
								:id="campo"
								v-model="usuario[campo]"
								autocomplete="off"
							>
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-center align-items-center my-3" @click="guardar()"><button class="btn btn-outline-success btn-lg py-2"><i class="bi bi-arrow-clockwise"></i> Registrar usuario</button></div>

		</section>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
	const { createApp, ref, onMounted } = Vue

	createApp({
		setup() {
			const servidor = '<?= $api ?>'
			const usuario=ref({
					paterno:'',
					materno:'',
					name:'',
					usuario:'',
					correo:'',
					celular:'',
					direccion:'',
					password:'', nivel:2
				})

			onMounted(()=>{
				//vacio
			})

			function guardar(){				
				axios.post(servidor+'usuarios/', usuario.value)
				.then(resp=> {
					if(resp.data.error) alert(error)
					else window.location ='http://localhost/wanca-vuelos/usuario-perfil.php?id='+resp.data.id
				})
			}

			function generar(){
				usuario.value.usuario = (usuario.value.name.charAt(0) + usuario.value.paterno).toLowerCase();
			}

			return {
				usuario, guardar, generar
			}
		}
	}).mount('#app')
</script>
</body>
</html>