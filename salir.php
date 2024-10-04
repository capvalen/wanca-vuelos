<?php
$cookies = array_keys($_COOKIE);
foreach ($cookies as $cookie) {
	setcookie($cookie, '', time() - 3600, '/'); // Expira en una hora
}
header('Location: index.php');
?>