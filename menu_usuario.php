<div class="d-flex justify-content-between me-5">
	<p class="mb-0 text-muted"><small><strong>Usuario actual:</strong> <span class="text-capitalize"><?= $_COOKIE['nombre_usuario'] ?></span></small></p>
	<p class="mb-0 text-muted"><small><strong>Nivel: </strong>
		<?php if( $_COOKIE['nivel']==1 ):?>
			<span>Administrador</span>
		<?php else:?>
			<span v-else>Colaborador</span>
		<?php endif; ?>
		 <a class="text-decoration-none" href="salir.php"><i class="bi bi-door-open"></i> Cerrar sesión</a></small></p>
</div>
<hr class="opacity-25">
<h1><?= $titulo_pagina; ?></h1>