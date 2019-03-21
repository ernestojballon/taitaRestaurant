<?php
session_start();

if(!$_SESSION['mesa'])
{
	// redirecciona a la pagina
         $host = $_SERVER["HTTP_HOST"];
         header("Location: http://$host/inicio.php");
         exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>	
	<meta charset="UTF-8">
	<title>Proyectos III:cocina</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/codigo.js"></script>
</head>
<body>
	<div class="contenedor_cocina">
		<div class="contenedor">
			<div class="div_ordenes">
				<h1 class="Ordenes:">Ordenes Pendientes</h1>
				<section class="orden" id="pendientes">
				</section>
			</div>
		</div>
	</div>	
	
	
</body>
</html>