<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'header.php'; ?>
</head>
<body>
	<div class="row" id="app">
		<section class="col col-md-9 container my-5 " >
			<h1 class="text-center mb-5">Intranet Tradición Wanka</h1>
			<div class="row justify-content-center">
				<div class="col-6">
					<div class="card">
						<div class="card-body">
							<div class="mx-auto w-75 mb-3"><img src="img/logo.jpg" class="img-fluid"></div>
							<h2 class="text-center">Inicio de sesión</h2>
							<div>
								<div class="mb-3">
									<label for="email" class="form-label">Usuario</label>
									<input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico" autocapitalize="off" v-model="usuario">
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Contraseña</label>
									<input type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" autocapitalize="off" v-model="clave" @keypress.enter="iniciar()">
								</div>
								<div class="d-flex d-grid justify-content-center" @click="iniciar()"><button class="btn btn-outline-primary btn-lg"><i class="bi bi-door-open"></i> Ingresar</button></div>
							</div>
						</div>
					</div>
					<p class="text-end mt-3"><small><?= include 'php/version.php'; ?></small></p>
				</div>
			</div>
		</section>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
	<script>
		const { createApp, ref, onMounted } = Vue
	
		createApp({
			setup() {
				const servidor = 'http://localhost/documentos-cimal/api/'
				const usuario = ref('')
				const clave = ref('')
				
				onMounted(()=>{
					//Descomentar cuando pase a producción
					/*localStorage.removeItem('idUsuario')
					localStorage.removeItem('nombreUsuario')*/
				})

				async function iniciar(){
					let datos = new FormData()
					datos.append('usuario', usuario.value)
					datos.append('clave', clave.value)
					const serv = await fetch('php/validarLogin.php',{
						method:'POST', body:datos
					})
					const response = await serv.json()
					if(response.mensaje == 'ok'){
						localStorage.setItem('idUsuario', response.usuario.idUsuario)
						localStorage.setItem('nombreUsuario', response.usuario.paterno +" " + response.usuario.materno + " " + response.usuario.nombres)
						localStorage.setItem('nivel', response.usuario.nivel)
						window.location='principal.php'
					}else{
						alert('Un dato esta mal, o esta dehabilitado')
					}
				}

				return {
					servidor, iniciar, usuario, clave,
				}
			}
		}).mount('#app')
	</script>
</body>
</html>