<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'header.php'; ?>
</head>
<body>
	<main class="container-fluid" id="app">
    <h1>Plantilla Blank</h1>
		<div >{{ message }}</div>
	</main>
	
	<?php include 'footer.php'; ?>
	<script>
  const { createApp, ref } = Vue

  createApp({
    setup() {
      const message = ref('Hello vue!')
      return {
        message
      }
    }
  }).mount('#app')
</script>
</body>
</html>