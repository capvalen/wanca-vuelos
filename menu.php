<?php $url_completa = $_SERVER['REQUEST_URI'];
$pagina = basename($url_completa, '.php');
?>
<div class="mx-auto w-75 mb-3"><img src="img/logo.jpg" class="img-fluid"></div>
<div class="list-group list-group-flush">
	<a href="principal.php" type="button" class="list-group-item list-group-item-action <?= $pagina=='principal'? 'active':'' ?>" aria-current="true">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-house"></i> Inicio</span> 
	</a>
	<a href="clientes.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-file-medical"></i> Clientes</span> 
	</a>
	<a href="aportaciones.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-piggy-bank"></i> Aportaciones</span> 
	</a>
	<a href="participantes.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-people"></i> Participantes</span> 
	</a>
	<a href="documentacion.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-file-earmark-break"></i> Documentación</span> 
	</a>
	<a href="boletos.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-ticket-perforated"></i> Boletos</span> 
	</a>
	<a href="reportes.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-bag"></i> Reportes</span> 
	</a>
	<a href="proveedores.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-airplane"></i> Proveedores</span> 
	</a>
	<a href="caja.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-cart"></i> Caja</span> 
	</a>
	<a href="paquetes.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-box"></i> Paquetes</span> 
	</a>
	<a href="tours.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-truck-front"></i> Tours</span> 
	</a>
	<a href="configuraciones.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-gear-fill"></i> Configuraciones</span> 
	</a>
	<a href="perfil.php" type="button" class="list-group-item list-group-item-action">
		<i class="bi bi-caret-right"></i> <span class="icono"><i class="bi bi-gear-fill"></i> Mi perfil</span> 
	</a>
</div>